<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="FormTypeRequest",
 *     description="Создание типа формы обратной связи",
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
class FormTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required|unique:form_types,name',
        ];
    }
}
