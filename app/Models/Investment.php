<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int         $customer_id
 * @property int         $amount
 * @property float       $percent
 * @property string      $currency
 * @property Carbon|null $deleted_at
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @property-read  Customer               $customer
 * @property-read Collection<Transaction> $transactions
 */
class Investment extends Model
{
    protected $fillable = [
        'customer_id',
        'amount',
        'percent',
        'currency'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
