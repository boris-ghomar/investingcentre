<?php

namespace App\Models;

use App\Contracts\EmailCipherContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KirschbaumDevelopment\NovaMail\Traits\Mailable;

/**
 * @property string $username
 * @property string $domain
 * @property string $email
 *
 * @method  Builder|static  email(string $email)
 * @method  static  Builder|static  email(string $email)
 */
class Invitation extends Model
{
    use HasFactory, SoftDeletes, Mailable;

    protected $fillable = [
        'username',
        'domain'
    ];

    public function getEmailField(): string
    {
        return "email";
    }

    public function getEmailAttribute(): string
    {
        return app(EmailCipherContract::class)->decrypt($this->username, $this->domain);
    }

    public function scopeEmail(Builder $query, string $email)
    {
        $encryptedEmail = app(EmailCipherContract::class)->encrypt($email);

        $query->where("username", $encryptedEmail->username)->where("domain", $encryptedEmail->domain);
    }

}
