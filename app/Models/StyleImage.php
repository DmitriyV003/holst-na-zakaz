<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class StyleImage extends Model  implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'style_id',
        'slide_number',
    ];

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }

    public function imageMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'media');
    }
}
