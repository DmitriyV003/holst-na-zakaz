<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class InvoiceResource.
 *
 * @OA\Schema(
 *     title="InvoiceResource",
 *     description="InvoiceResource model",
 *     type="object",
 *     @OA\Property(
 *          property="id",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="type",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="amount",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="old_price",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="created_at",
 *          type="dateTime"
 *     ),
 *      @OA\Property(
 *          property="updated_at",
 *          type="dateTime"
 *     ),
 *     @OA\Property(
 *          property="order",
 *          type="object",
 *          ref="#/components/schemas/OrderResource"
 *     )
 * )
 */
class InvoiceResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'amount' => $this->amount->toDecimalString(4),
            'order' => new OrderResource($this->whenLoaded('order')),
            'created_at' => $this->formatDateField($this->created_at),
            'updated_at' => $this->formatDateField($this->updated_at),
        ];
    }
}
