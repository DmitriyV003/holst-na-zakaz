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
            'fields' => 'nullable|array',
            'fields.*.field_id' => 'exists:field_types,id',
            'fields.*.value' => 'required|string',
        ];
    }
}
