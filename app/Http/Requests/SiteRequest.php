<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                Rule::unique('sites', 'name'),
            ],
            'address' => 'string|required',
            'email' => 'string|required',
            'skype' => 'string|nullable',
            'phone_country' => 'string|required',
            'phone_moscow' => 'string|required',
            'phone_spb' => 'string|required',
            'support' => 'string|required',
            'work_hours' => 'string|required',
            'tin' => 'string|required',
            'ip' => 'string|required',
        ];
    }
}
