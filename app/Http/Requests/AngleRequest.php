<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PostScripton\Money\Rules\Money;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="AngleRequest",
 *     description="Запрос для создния, обновления уголков",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="name",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="code",
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
 *                  property="media_id",
 *                  type="integer"
 *              )
 *         )
 *     )
 * )
 */
class AngleRequest extends FormRequest
{
    public function rules(): array
    {
        $uniqueRule = Rule::unique('angles', 'code');
        if (isset($this->angle)) {
            $uniqueRule->ignore($this->angle->id);
        }

        return [
            'name' => [
                'required',
                'string',
            ],
            'code' => [
                'required',
                'string',
                $uniqueRule
            ],
            'price' => [
                'required',
                app(Money::class),
            ],
            'old_price' => [
                'nullable',
                app(Money::class),
            ],
            'media_id' => [
                'required',
                Rule::exists('media', 'id'),
            ],
        ];
    }
}
