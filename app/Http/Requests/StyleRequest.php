<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PostScripton\Money\Rules\Money;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="StyleRequest",
 *     description="Создание стиля",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="name",
 *                  type="string",
 *                  nullable="false"
 *              ),
 *              @OA\Property(
 *                  property="is_show",
 *                  type="boolean",
 *                  nullable="false"
 *              ),
 *              @OA\Property(
 *                  property="site_id",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="price",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="old_price",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="media_ids",
 *                  type="array",
 *                  @OA\Items(type="integer")
 *              )
 *         )
 *     )
 * )
 */
class StyleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'price' => [
                'required',
                app(Money::class),
            ],
            'old_price' => [
                'nullable',
                app(Money::class),
            ],
            'site_id' => [
                'required',
                'integer',
                Rule::exists('sites', 'id'),
            ],
            'is_show' => [
                'boolean',
                'required',
            ],
            'media_ids' => [
                'nullable',
                'array',
            ],
            'media_ids.*' => [
                'integer',
                Rule::exists('media', 'id'),
            ],
        ];
    }
}
