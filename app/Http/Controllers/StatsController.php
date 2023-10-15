<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Http\Requests\StatsByPeriodRequest;
use App\Http\Resources\SizeResource;
use App\Models\Size;
use App\StatsManager;

class StatsController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/admin/stats",
     *     summary="Show stats by period",
     *     operationId="getStatsByPeriod",
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      property="debit",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="credir",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="revenue",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="orders",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="date",
     *                      type="dateTime"
     *                  )
     *              )
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/StatsByPeriodRequest")
     * )
     */
    public function statsByPeriod(StatsByPeriodRequest $request)
    {
        $dates = $request->validated();
        return app(
            StatsManager::class,
            ['startDate' => $dates['start_date'], 'endDate' => $dates['end_date']]
        )->statsByPeriod();
    }
}
