<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteRequest extends FormRequest
{
    public function rules(): array
    {
        $uniqueRule = Rule::unique('sites', 'name');
        if (isset($this->site)) {
            $uniqueRule->ignore($this->site->id);
        }

        return [
            'name' => [
                'string',
                $uniqueRule,
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
