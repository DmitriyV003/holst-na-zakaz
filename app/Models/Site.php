<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
