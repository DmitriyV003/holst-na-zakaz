<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FieldTypeResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->whenPivotLoaded('site_field_type', function () {
                return $this->pivot->value;
            }),
            'location' => $this->whenPivotLoaded('site_field_type', function () {
                return $this->pivot->location;
            }),
            'created_at' => $this->formatDateField($this->created_at),
            'updated_at' => $this->formatDateField($this->updated_at),
        ];
    }
}
