<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'email',
        'skype',
        'phone_country',
        'phone_moscow',
        'phone_spb',
        'support',
        'work_hours',
        'tin',
        'ip',
    ];

    public function fieldTypes(): BelongsToMany
    {
        return $this->belongsToMany(FieldType::class, 'site_field_type')->withPivot('value', 'location');
    }
}
