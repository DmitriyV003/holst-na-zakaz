<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * Class SiteResource.
 *
 * @OA\Schema(
 *     title="SiteResource",
 *     description="SiteResource model",
 *     type="object",
 *     @OA\Property(
 *          property="id",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="name",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="main_image",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="main_title",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="address",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="emial",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="skype",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="phone_country",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="phone_moscow",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="phone_spb",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="support",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="work_hours",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="tin",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="ip",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="created_at",
 *          type="dateTime"
 *     ),
 *     @OA\Property(
 *          property="updated_at",
 *          type="dateTime"
 *     ),
 *     @OA\Property(
 *          property="deleted_at",
 *          type="dateTime"
 *     )
 * )
 */
class SiteResource extends Resource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->formatDateField($this->created_at),
            'updated_at' => $this->formatDateField($this->updated_at),
        ];
    }
}
