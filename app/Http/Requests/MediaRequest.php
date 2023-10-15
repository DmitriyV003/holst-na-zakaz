<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="MediaRequest",
 *     description="Загрузка файла",
 *     required=true,
 *     @OA\MediaType(
 *         mediaType="multipart/form-data",
 *         @OA\Schema(
 *             @OA\Property(
 *                  property="file",
 *                  type="string",
 *                  format="binary"
 *              )
 *         )
 *     )
 * )
 */
class MediaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'bail',
                'file',
            ]
        ];
    }
}
