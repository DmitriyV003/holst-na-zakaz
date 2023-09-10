<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PostScripton\Money\Casts\MoneyCast;

class Style extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'site_id',
        'is_show',
        'price',
        'old_price',
    ];

    protected $casts = [
        'price' => MoneyCast::class,
        'old_price' => MoneyCast::class,
    ];

    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }
}
