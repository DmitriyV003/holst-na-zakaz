<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PostScripton\Money\Casts\MoneyCast;

class Invoice extends Model
{
    public const DEBIT_TYPE = 'debit';
    public const CREDIT_TYPE = 'credit';

    protected $fillable = [
        'type',
        'amount',
        'order_id',
    ];

    protected $casts = [
        'amount' => MoneyCast::class,
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
