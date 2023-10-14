<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class AngleResource.
 *
 * @OA\Schema(
 *     title="AngleResource",
 *     description="AngleResource model",
 *     type="object",
 *     @OA\Property(
 *          property="id",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="name",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="code",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="price",
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
 *          property="media",
 *          type="object",
 *          ref="#/components/schemas/MediaResource"
 *     )
 * )
 */
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
