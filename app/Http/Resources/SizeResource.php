<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/** @mixin \App\Models\Size */
class SizeResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'size' => $this->resource->size,
            'is_show' => $this->resource->is_show,
            'site_id' => $this->resource->site_id,
            'price' => $this->resource->price->toDecimalString(0),
            'old_price' => $this->resource->old_price ? $this->resource->old_price->toDecimalString(0) : null,
            'created_at' => $this->formatDateField($this->resource->created_at),
            'updated_at' => $this->formatDateField($this->resource->updated_at),
        ];
    }
}
