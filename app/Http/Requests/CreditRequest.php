<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;
use PostScripton\Money\Rules\Money;

/**
 * @OA\RequestBody(
 *     request="CreditRequest",
 *     description="Запрос на создание расходного ивойса",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="amount",
 *                  type="integer"
 *              )
 *         )
 *     )
 * )
 */
class CreditRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                app(Money::class),
            ],
        ];
    }
}
