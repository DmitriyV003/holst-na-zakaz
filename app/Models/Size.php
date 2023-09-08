<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'size',
        'is_show',
        'site_id',
        'price',
    ];
}
