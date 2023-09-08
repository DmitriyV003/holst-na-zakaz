<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PostScripton\Money\Casts\MoneyCast;

class Order extends Model
{
    public const NEW_STATUS = 'new';

    protected $fillable = [
        'status',
        'admin_comment',
        'delivery_date',
        'delivery_address',
        'price',
        'faces',
        'form_application_id',
        'size_id',
        'angle_id',
    ];

    protected $attributes = [
        'status' => self::NEW_STATUS,
    ];

    protected $casts = [
        'delivery_date' => 'datetime',
        'price' => MoneyCast::class,
    ];

    public function formApplication(): BelongsTo
    {
        return $this->belongsTo(FormApplication::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function angle(): BelongsTo
    {
        return $this->belongsTo(Angle::class);
    }

    public function debitInvoices(): HasMany
    {
        return $this->hasMany(Invoice::class)->where('type', Invoice::DEBIT_TYPE);
    }

    public function creditInvoices(): HasMany
    {
        return $this->hasMany(Invoice::class)->where('type', Invoice::CREDIT_TYPE);
    }
}
