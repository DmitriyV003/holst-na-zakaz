<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PostScripton\Money\Rules\Money;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="SizeRequest",
 *     description="Создание размера холста",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="size",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="is_show",
 *                  type="boolean"
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
 *              )
 *         )
 *     )
 * )
 */
class SizeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'size' => [
                'required',
                'string',
            ],
            'is_show' => [
                'required',
                'boolean',
            ],
            'site_id' => [
                'required',
                'integer',
                Rule::exists('sites', 'id'),
            ],
            'price' => [
                'required',
                app(Money::class),
            ],
            'old_price' => [
                'nullable',
                app(Money::class),
            ],
        ];
    }
}
