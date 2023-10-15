<?php

namespace App\Http\Controllers;

use App\AngleManager;
use App\Http\Requests\AngleRequest;
use App\Http\Resources\AngleResource;
use App\Models\Angle;

class AngleController extends Controller
{
    private const PER_PAGE = 20;

    /**
     * @OA\Get(
     *     path="/api/v1/angle",
     *     summary="Returns paginated angles",
     *     operationId="getAllAngles",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/AngleResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return AngleResource::collection(Angle::query()->with('imageMedia')->paginate(self::PER_PAGE));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/admin/angle",
     *     summary="Create angle",
     *     operationId="storeAngle",
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/AngleResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/AngleRequest")
     * )
     */
    public function store(AngleRequest $request)
    {
        $params = $request->validated();
        $this->formatParams($params);
        $angle = app(AngleManager::class, ['angle' => null])->create($params);

        return new AngleResource($angle->load('imageMedia'));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/admin/angle/{id}",
     *     summary="Returns angle by id",
     *     operationId="getAngleById",
     *     @OA\Parameter(
     *          in="path",
     *          required=true,
     *          name="id",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         ref="#/components/schemas/AngleResource"
     *     )
     * )
     */
    public function show(Angle $angle)
    {
        return new AngleResource($angle);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/admin/angle/{id}",
     *     summary="Update angle by id",
     *     operationId="updateAngle",
     *     @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/AngleResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/AngleRequest")
     * )
     */
    public function update(AngleRequest $request, Angle $angle)
    {
        $params = $request->validated();
        $this->formatParams($params);
        app(AngleManager::class, ['angle' => $angle])->update($params);

        return new AngleResource($angle);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/admin/angle/{id}",
     *     summary="Delete angle",
     *     operationId="deleteAngle",
     *     @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="successful"
     *     )
     * )
     */
    public function destroy(Angle $angle)
    {
        $angle->delete();

        return response()->json();
    }

    private function formatParams(array &$params)
    {
        if (isset($params['price'])) {
            $params['price'] = money_parse($params['price']);
        }
        if (isset($params['old_price'])) {
            $params['old_price'] = money_parse($params['old_price']);
        }
    }
}
