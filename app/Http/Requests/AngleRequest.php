<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PostScripton\Money\Rules\Money;

class AngleRequest extends FormRequest
{
    public function rules(): array
    {
        $uniqueRule = Rule::unique('angles', 'code');
        if (isset($this->angle)) {
            $uniqueRule->ignore($this->angle->id);
        }

        return [
            'name' => [
                'required',
                'string',
            ],
            'code' => [
                'required',
                'string',
                $uniqueRule
            ],
            'price' => [
                'required',
                app(Money::class),
            ],
            'old_price' => [
                'nullable',
                app(Money::class),
            ],
            'media_id' => [
                'required',
                Rule::exists('media', 'id'),
            ],
        ];
    }
}
