<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class MediaResource.
 *
 * @OA\Schema(
 *     title="MediaResource",
 *     description="MediaResource model",
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
 *          property="src",
 *          type="string"
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
class MediaResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'src' => $this->resource->getUrl(),
            'created_at' => $this->formatDateField($this->resource->created_at),
            'updated_at' => $this->formatDateField($this->resource->updated_at),
        ];
    }
}
