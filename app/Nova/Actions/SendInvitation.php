<?php

namespace App\Nova\Actions;

use Illuminate\Mail\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class SendInvitation extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models): mixed
    {
        foreach ($models as $model) {
            $registartion_link = route('customer.register', [
                'id' => $model->id,
                'token' => md5($model->email . now()),
            ]);
            Mail::raw($fields->body . "\n\nRegistration Link: " . $registartion_link, function (Message $message) use ($fields, $model) {
                $message->to($model->email)
                    ->subject($fields->subject);
            });
        }
        return Action::message('Invitation email sent successfully!');

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
            Text::make('Email Subject','subject')->rules('required','max:255')->help("Enter the subject for invitation"),
            Textarea::make('Email body','body')->help("Enter the email content that will be sent to the customer"),
        ];
    }
}
