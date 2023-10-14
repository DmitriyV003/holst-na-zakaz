<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

use OpenApi\Annotations as OA;

/**
 * Class StyleResource.
 *
 * @OA\Schema(
 *     title="StyleResource",
 *     description="StyleResource model",
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
 *          property="site",
 *          type="object",
 *          ref="#/components/schemas/SiteResource"
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
 *          property="is_show",
 *          type="boolean"
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
class StyleResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'site_id' => $this->resource->site_id,
            'price' => $this->resource->price->toDecimalString(0),
            'old_price' => $this->resource->old_price ? $this->resource->old_price->toDecimalString(0) : null,
            'media' => MediaResource::collection($this->whenLoaded('images')),
            'created_at' => $this->formatDateField($this->resource->created_at),
            'updated_at' => $this->formatDateField($this->resource->updated_at),
        ];
    }
}
