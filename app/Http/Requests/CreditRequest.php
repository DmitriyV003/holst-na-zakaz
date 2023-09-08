<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreditRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => 'required|integer',
        ];
    }
}
