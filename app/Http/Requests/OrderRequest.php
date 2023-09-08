<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'admin_comment' => 'nullable|string',
            'phone' => 'required_without:form_application_id|string',
            'delivery_date' => 'nullable|date',
            'delivery_address' => 'nullable|string',
            'price' => 'required|integer',
            'faces' => 'required|integer',
            'form_application_id' => [
                'nullable',
                'integer',
                Rule::exists('form_applications', 'id'),
            ],
            'form_type_id' => [
                'required_without:form_application_id',
                'integer',
                Rule::exists('form_types', 'id'),
            ],
            'size_id' => [
                'required',
                'integer',
                Rule::exists('sizes', 'id'),
            ],
            'angle_id' => [
                'required',
                'integer',
                Rule::exists('angles', 'id'),
            ],
        ];
    }
}
