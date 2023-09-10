<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PostScripton\Money\Rules\Money;

class StyleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'price' => [
                'required',
                app(Money::class),
            ],
            'old_price' => [
                'nullable',
                app(Money::class),
            ],
            'site_id' => [
                'required',
                'integer',
                Rule::exists('sites', 'id'),
            ],
            'is_show' => [
                'boolean',
                'required',
            ],
            'media_ids' => [
                'nullable',
                'array',
            ],
            'media_ids.*' => [
                'integer',
                Rule::exists('media', 'id'),
            ],
        ];
    }
}
