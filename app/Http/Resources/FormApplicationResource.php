<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class FormApplicationResource.
 *
 * @OA\Schema(
 *     title="FormApplicationResource",
 *     description="FormApplicationResource model",
 *     type="object",
 *     @OA\Property(
 *          property="id",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="phone",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="comment",
 *          type="string"
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
 *          property="form_type",
 *          type="object",
 *          ref="#/components/schemas/FormTypeResource"
 *     )
 * )
 */
class FormApplicationResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'phone' => $this->resource->phone,
            'comment' => $this->resource->comment,
            'form_type' => new FormTypeResource($this->whenLoaded('formType')),
            'media' => new MediaResource($this->whenLoaded('imageMedia')),
            'created_at' => $this->formatDateField($this->created_at),
            'updated_at' => $this->formatDateField($this->updated_at),
        ];
    }
}
