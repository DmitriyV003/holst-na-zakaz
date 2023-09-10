<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PostScripton\Money\Rules\Money;

class SizeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'size' => [
                'required',
                'string',
            ],
            'is_show' => [
                'required',
                'boolean',
            ],
            'site_id' => [
                'required',
                'integer',
                Rule::exists('sites', 'id'),
            ],
            'price' => [
                'required',
                app(Money::class),
            ],
            'old_price' => [
                'nullable',
                app(Money::class),
            ],
        ];
    }
}
