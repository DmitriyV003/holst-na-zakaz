<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/** @mixin \App\Models\Angle */
class AngleResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'price' => $this->resource->price->toDecimalString(0),
            'old_price' => $this->resource->old_price ? $this->resource->old_price->toDecimalString(0) : null,
            'created_at' => $this->formatDateField($this->created_at),
            'updated_at' => $this->formatDateField($this->updated_at),
            'media' => new MediaResource($this->whenLoaded('imageMedia')),
        ];
    }
}
