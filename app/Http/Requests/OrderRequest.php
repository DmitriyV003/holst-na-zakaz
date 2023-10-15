<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PostScripton\Money\Rules\Money;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="OrderRequest",
 *     description="Создание заказа",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="admin_comment",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="phone",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="delivery_date",
 *                  type="dateTime"
 *              ),
 *              @OA\Property(
 *                  property="delivery_address",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="price",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="faces",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="form_application_id",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="form_type_id",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="size_id",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="angle_id",
 *                  type="integer"
 *              )
 *         )
 *     )
 * )
 */
class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'admin_comment' => 'nullable|string',
            'phone' => 'required_without:form_application_id|string',
            'delivery_date' => 'nullable|date',
            'delivery_address' => 'nullable|string',
            'price' => [
                'required',
                app(Money::class),
            ],
            'faces' => 'required|integer',
            'form_application_id' => [
                'nullable',
                'integer',
                Rule::exists('form_applications', 'id'),
            ],
            'form_type_id' => [
                'required_without:form_application_id',
                'integer',
                Rule::exists('form_types', 'id'),
            ],
            'size_id' => [
                'required',
                'integer',
                Rule::exists('sizes', 'id'),
            ],
            'angle_id' => [
                'required',
                'integer',
                Rule::exists('angles', 'id'),
            ],
        ];

        if (isset($this->order)) {
            $rules['form_application_id'] = [
                'required',
                'integer',
                Rule::exists('form_applications', 'id'),
            ];
        }

        return $rules;
    }
}
