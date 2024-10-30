<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $investment_id
 * @property int    $amount
 * @property string $type
 * @property array  $properties
 *
 * @property-read Collection<Investment> $investments
 */
class Transaction extends Model
{
    const ACCOUNT_NUMBER = 'account_number';
    const CRYPTO_ADDRESS = 'crypto_address';
    const BETCART_ID = 'betcart_id';
    protected $fillable = [
        'investment_id',
        'amount',
        'type',
        'properties'
    ];

    protected $casts = [
        'properties' => 'array'
    ];
    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    public function getPropertyAttribute()
    {
        return match ($this->type) {
            'credit_card' => $this->properties[self::ACCOUNT_NUMBER] ?? null,
            'crypto' => $this->properties[self::CRYPTO_ADDRESS] ?? null,
            'game' => $this->properties[self::BETCART_ID] ?? null,
            default => null,
        };
    }

    public function setPropertyAttribute($value): void
    {
        $this->attributes['properties'] = match ($this->type) {
            'credit_card' => json_encode([self::ACCOUNT_NUMBER => $value]),
            'crypto' => json_encode([self::CRYPTO_ADDRESS => $value]),
            'game' => json_encode([self::BETCART_ID => $value]),
            default => json_encode([]),
        };
    }
}
