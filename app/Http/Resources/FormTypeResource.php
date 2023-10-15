<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/**
 * Class FormTypeResource.
 *
 * @OA\Schema(
 *     title="FormTypeResource",
 *     description="FormTypeResource model",
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
 *          property="created_at",
 *          type="dateTime"
 *     ),
 *      @OA\Property(
 *          property="updated_at",
 *          type="dateTime"
 *     ),
 *     @OA\Property(
 *          property="deleted_at",
 *          type="dateTime"
 *     )
 * )
 */
class FormTypeResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->formatDateField($this->created_at),
            'deleted_at' => $this->formatDateField($this->deleted_at),
            'updated_at' => $this->formatDateField($this->updated_at),
        ];
    }
}
