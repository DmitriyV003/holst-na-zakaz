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
 *          property="value",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="location",
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
 *      @OA\Property(
 *          property="deleted_at",
 *          type="dateTime"
 *     )
 * )
 */
class FieldTypeResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->whenPivotLoaded('site_field_type', function () {
                return $this->pivot->value;
            }),
            'location' => $this->whenPivotLoaded('site_field_type', function () {
                return $this->pivot->location;
            }),
            'created_at' => $this->formatDateField($this->created_at),
            'updated_at' => $this->formatDateField($this->updated_at),
        ];
    }
}
