<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FormApplication extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'phone',
        'comment',
        'form_type_id',
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function imageMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'media');
    }
}
