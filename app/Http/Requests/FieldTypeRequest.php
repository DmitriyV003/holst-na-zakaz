<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="FieldTypeRequest",
 *     description="Создание типа поля для связи с сущностью Site",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="name",
 *                  type="string"
 *              )
 *         )
 *     )
 * )
 */
class FieldTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
        ];
    }
}
