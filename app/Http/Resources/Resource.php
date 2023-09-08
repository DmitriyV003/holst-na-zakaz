<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use RuntimeException;

class Resource extends JsonResource
{
    protected function formatDateField($value): string|null
    {
        if (!$value) {
            return null;
        } else if ($value instanceof Carbon) {
            return $value->toDateTimeString();
        } else if (is_string($value)) {
            return (new Carbon($value))->toDateTimeString();
        }

        throw new RuntimeException('invalid datetime type');
    }
}
