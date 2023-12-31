<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class SizeResource.
 *
 * @OA\Schema(
 *     title="SizeResource",
 *     description="SizeResource model",
 *     type="object",
 *     @OA\Property(
 *          property="id",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="size",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="is_show",
 *          type="boolean"
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
 *          property="site",
 *          type="object",
 *          ref="#/components/schemas/SiteResource"
 *     ),
 *     @OA\Property(
 *          property="created_at",
 *          type="dateTime"
 *     ),
 *     @OA\Property(
 *          property="updated_at",
 *          type="dateTime"
 *     ),
 *     @OA\Property(
 *          property="deleted_at",
 *          type="dateTime"
 *     )
 * )
 */
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
