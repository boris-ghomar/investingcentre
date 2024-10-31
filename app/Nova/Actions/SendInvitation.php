<?php

namespace App\Nova\Actions;

use App\Contracts\EmailCipherContract;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use KirschbaumDevelopment\NovaMail\Mail\Send;
use KirschbaumDevelopment\NovaMail\Models\NovaMailTemplate;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResponse;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Lednerb\ActionButtonSelector\ShowAsButton;

class SendInvitation extends Action
{
    use Queueable, SerializesModels, InteractsWithQueue, ShowAsButton;

    public $name = "Send Invitation";
    public $standalone = true;
    public $confirmText = "";
    public $confirmButtonText = "Send";
    public $onlyOnIndex = true;

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return Action|ActionResponse
     */

    public function handle(ActionFields $fields, Collection $models): ActionResponse|Action
    {
        $invitation_template = NovaMailTemplate::where('name', 'Invitation')->first();

        if (!$invitation_template) {
            return Action::danger("Invitation template not found.");
        }

        if (Invitation::email($fields->email)->exists()) {
            return Action::danger("The email {$fields->email} has already been invited.");
        }

        $encryptedEmail = app(EmailCipherContract::class)->encrypt($fields->email);

        $invitation = new Invitation();
        $invitation->username = $encryptedEmail->username;
        $invitation->domain = $encryptedEmail->domain;
        $invitation->save();
        $mailable = new Send(
            $invitation,
            $invitation_template,
            $invitation_template->content,
            $invitation->email,
            $invitation_template->subject,
            null,
            0
        );
        try {
            $mailable->deliver();
            return Action::message("Invitation sent successfully to { $invitation->email}.");
        } catch (\Exception $e) {
            return Action::danger("Failed to send invitation to { $invitation->email}. Error: {$e->getMessage()}");
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Text::make('Email')->rules('required', 'email'),
        ];
    }
}
