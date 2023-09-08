<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/** @mixin \App\Models\FormApplication */
class FormApplicationResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'phone' => $this->resource->phone,
            'comment' => $this->resource->comment,
            'form_type' => new FormTypeResource($this->whenLoaded('formType')),
            'created_at' => $this->formatDateField($this->created_at),
            'updated_at' => $this->formatDateField($this->updated_at),
        ];
    }
}
