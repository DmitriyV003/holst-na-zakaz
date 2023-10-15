<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="SiteRequest",
 *     description="Запрос для создния, обновления сайта",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="name",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="fields",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(
 *                          property="field_id",
 *                          type="integer",
 *                          nullable="false"
 *                      ),
 *                      @OA\Property(
 *                          property="value",
 *                          type="string",
 *                          nullable="false"
 *                      ),
 *                      @OA\Property(
 *                          property="location",
 *                          type="string",
 *                          nullable="false"
 *                      )
 *                  )
 *              )
 *         )
 *     )
 * )
 */
class SiteRequest extends FormRequest
{
    public function rules(): array
    {
        $uniqueRule = Rule::unique('sites', 'name');
        if (isset($this->site)) {
            $uniqueRule->ignore($this->site->id);
        }

        return [
            'name' => [
                'string',
                $uniqueRule,
            ],
            'fields' => 'nullable|array',
            'fields.*.field_id' => 'exists:field_types,id',
            'fields.*.value' => 'required|string',
            'fields.*.location' => 'required|string',
        ];
    }
}
