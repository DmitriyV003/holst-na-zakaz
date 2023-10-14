<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="FormApplication",
 *     description="Pet object that needs to be added to the store",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="phone",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="comment",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="form_type_id",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="media_id",
 *                  type="integer"
 *              ),
 *         )
 *
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
                'nullable',
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
