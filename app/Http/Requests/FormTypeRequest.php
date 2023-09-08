<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required|unique:form_types,name',
        ];
    }
}
