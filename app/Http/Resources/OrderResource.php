<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/** @mixin \App\Models\Order */
class OrderResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'status' => $this->resource->status,
            'admin_comment' => $this->resource->admin_comment,
            'delivery_date' => $this->formatDateField($this->resource->delivery_date),
            'delivery_address' => $this->resource->delivery_address,
            'price' => $this->resource->price->toDecimalString(4),
            'faces' => $this->resource->faces,
            'form_application' => new FormApplicationResource($this->whenLoaded('formApplication')),
            'debit' =>  InvoiceResource::collection($this->whenLoaded('debitInvoices')),
            'credit' => InvoiceResource::collection($this->whenLoaded('creditInvoices')),
            'size' => new SizeResource($this->whenLoaded('size')),
            'angle' => new AngleResource($this->whenLoaded('angle')),
            'created_at' => $this->formatDateField($this->resource->created_at),
            'updated_at' => $this->formatDateField($this->resource->updated_at),
        ];
    }
}
