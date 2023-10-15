<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
        ];
    }
}
