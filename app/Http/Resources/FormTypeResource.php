<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/** @mixin \App\Models\FormType */
class FormTypeResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->formatDateField($this->created_at),
            'deleted_at' => $this->formatDateField($this->deleted_at),
            'updated_at' => $this->formatDateField($this->updated_at),
        ];
    }
}
