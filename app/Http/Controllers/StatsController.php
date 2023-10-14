<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Http\Requests\StatsByPeriodRequest;
use App\Http\Resources\SizeResource;
use App\Models\Size;
use App\StatsManager;

class StatsController extends Controller
{
    public function statsByPeriod(StatsByPeriodRequest $request)
    {
        $dates = $request->validated();
        return app(
            StatsManager::class,
            ['startDate' => $dates['start_date'], 'endDate' => $dates['end_date']]
        )->statsByPeriod();
    }
}
