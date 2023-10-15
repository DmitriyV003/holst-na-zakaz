<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="StatsByPeriodRequest",
 *     description="Статистика за период",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="start_date",
 *                  type="dateTime",
 *                  nullable="false"
 *              ),
 *              @OA\Property(
 *                  property="end_date",
 *                  type="dateTime",
 *                  nullable="false"
 *              )
 *         )
 *     )
 * )
 */
class StatsByPeriodRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
            ],
        ];
    }
}
