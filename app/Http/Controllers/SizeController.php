<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Http\Resources\SizeResource;
use App\Models\Size;
use App\Traits\ParseToMoney;

class SizeController extends Controller
{
    use ParseToMoney;

    private const PER_PAGE = 20;

    /**
     * @OA\Get(
     *     path="/api/v1/admin/size",
     *     summary="Returns paginated sizes",
     *     operationId="getAllSizes",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/SizeResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return SizeResource::collection(Size::query()->paginate(self::PER_PAGE));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/admin/size",
     *     summary="Create size",
     *     operationId="storeSize",
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/SizeResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/SizeRequest")
     * )
     */
    public function store(SizeRequest $request)
    {
        $params = $request->validated();
        $this->formatParams($params);
        return new SizeResource(Size::create($params));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/admin/size/{id}",
     *     summary="Returns size by id",
     *     operationId="getSizeById",
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
     *         ref="#/components/schemas/SizeResource"
     *     )
     * )
     */
    public function show(Size $size)
    {
        return new SizeResource($size);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/admin/size/{id}",
     *     summary="Update size by id",
     *     operationId="updateSizeById",
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
     *             ref="#/components/schemas/SizeResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/SizeRequest")
     * )
     */
    public function update(SizeRequest $request, Size $size)
    {
        $params = $request->validated();
        $this->formatParams($params);
        $size->update($params);

        return new SizeResource($size);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/admin/size/{id}",
     *     summary="Delete size by id",
     *     operationId="deleteSizeById",
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
    public function destroy(Size $size)
    {
        $size->delete();

        return response()->json();
    }
}
