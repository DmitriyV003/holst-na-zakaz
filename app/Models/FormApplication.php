<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FormApplication extends Model
{
    protected $fillable = [
        'phone',
        'comment',
        'form_type_id',
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
