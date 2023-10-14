<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class OrderResource.
 *
 * @OA\Schema(
 *     title="OrderResource",
 *     description="OrderResource model",
 *     type="object",
 *     @OA\Property(
 *          property="id",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="status",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="admin_comment",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="delivery_date",
 *          type="datetime"
 *     ),
 *     @OA\Property(
 *          property="delivery_address",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="price",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="faces",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="form_application",
 *          type="object",
 *          ref="#/components/schemas/FormApplicationResource"
 *     ),
 *     @OA\Property(
 *          property="size",
 *          type="object",
 *          ref="#/components/schemas/SizeResource"
 *     ),
 *     @OA\Property(
 *          property="angle",
 *          type="object",
 *          ref="#/components/schemas/AngleResource"
 *     ),
 *     @OA\Property(
 *          property="created_at",
 *          type="dateTime"
 *     ),
 *      @OA\Property(
 *          property="updated_at",
 *          type="dateTime"
 *     )
 * )
 */
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
