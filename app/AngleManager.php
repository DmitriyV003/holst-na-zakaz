<?php

namespace App;

use App\Exceptions\ManagerException;
use App\Models\Angle;
use App\Models\Media;
use DB;
use http\Exception\RuntimeException;
use Throwable;

class AngleManager
{
    private ?Angle $angle;

    public function __construct(?Angle $angle)
    {
        $this->angle = $angle;
    }

    public function create(array $params): Angle
    {
        DB::transaction(function () use ($params) {
            $this->angle = Angle::create(collect($params)->except('media_id')->toArray());
            app(MediaManager::class, ['media' => Media::findOrFail($params['media_id'])])
                ->updateRelation($this->angle);
        });

        return $this->angle;
    }

    public function update(array $params): Angle
    {
        DB::transaction(function () use ($params) {
            $this->angle->update(collect($params)->except('media_id')->toArray());
            app(MediaManager::class, ['media' => Media::findOrFail($params['media_id'])])
                ->updateRelation($this->angle);
        });

        return $this->angle;
    }

}
