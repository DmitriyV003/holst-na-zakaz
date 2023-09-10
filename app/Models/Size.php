<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PostScripton\Money\Casts\MoneyCast;

class Size extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'size',
        'is_show',
        'site_id',
        'price',
        'old_price',
    ];

    protected $casts = [
        'price' => MoneyCast::class,
        'old_price' => MoneyCast::class,
    ];
}
