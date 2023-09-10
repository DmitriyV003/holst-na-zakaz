<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormApplicationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => [
                'required',
                'string',
            ],
            'comment' => [
                'string',
                'nullable',
            ],
            'form_type_id' => [
                'nullable',
                Rule::exists('form_types', 'id'),
            ],
            'media_id' => [
                'nullable',
                'integer',
                Rule::exists('media', 'id'),
            ],
        ];
    }
}
