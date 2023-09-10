<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use PostScripton\Money\Casts\MoneyCast;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Angle extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'code',
        'media_id',
        'price',
        'old_price',
    ];

    protected $casts = [
        'price' => MoneyCast::class,
        'old_price' => MoneyCast::class,
    ];

    public function imageMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'media');
    }
}
