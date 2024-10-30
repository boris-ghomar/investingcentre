<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KirschbaumDevelopment\NovaMail\Traits\Mailable;

/**
 * @property string      $name
 * @property string      $surname
 * @property string      $email
 * @property string      $password
 * @property string      $phone
 * @property Carbon|null $deleted_at
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @property-read  Collection<Investment> $investments
 */
class Customer extends Model
{
    use Mailable;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'phone'
    ];

    protected $hidden = [
        'password'
    ];

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }
    public function getEmailField(): string
    {
        return 'email';
    }
}
