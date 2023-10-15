<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="FormApplicationRequest",
 *     description="Создание формы обратной связи",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="phone",
 *                  type="string",
 *                  nullable="false"
 *              ),
 *              @OA\Property(
 *                  property="comment",
 *                  type="string",
 *                  nullable="true"
 *              ),
 *              @OA\Property(
 *                  property="form_type_id",
 *                  type="integer",
 *                  nullable="false"
 *              ),
 *              @OA\Property(
 *                  property="media_id",
 *                  type="integer",
 *                  nullable="true"
 *              ),
 *         )
 *     )
 * )
 */
class FormApplicationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => [
                'required',
                'string',
            ],
            'comment' => [
                'string',
                'nullable',
            ],
            'form_type_id' => [
                'required',
                Rule::exists('form_types', 'id'),
            ],
            'media_id' => [
                'nullable',
                'integer',
                Rule::exists('media', 'id'),
            ],
        ];
    }
}
