<?php

namespace App\Http\Controllers;

use App\Http\Requests\StyleRequest;
use App\Http\Resources\StyleResource;
use App\Models\Style;
use App\StyleManager;
use App\Traits\ParseToMoney;
use Illuminate\Http\Request;

class StyleController extends Controller
{
    use ParseToMoney;

    private const PER_PAGE = 20;

    /**
     * @OA\Get(
     *     path="/api/v1/admin/style",
     *     summary="Returns paginated styles",
     *     operationId="getAllStyles",
     *     @OA\Parameter(
     *          in="query",
     *          name="site_id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/StyleResource")
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Style::query()->with('styleImages.imageMedia')
            ->when($request->input('site_id'), function ($query, $siteId) {
                 $query->where('site_id', $siteId);
            });
        return StyleResource::collection($query->paginate(self::PER_PAGE));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/admin/style",
     *     summary="Create style",
     *     operationId="storeStyle",
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/StyleResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/StyleRequest")
     * )
     */
    public function store(StyleRequest $request)
    {
        $params = $request->validated();
        $this->formatParams($params);
        $style = app(StyleManager::class, ['style' => null])->create($params);
        return new StyleResource($style->load('styleImages.imageMedia'));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/admin/style/{id}",
     *     summary="Returns style by id",
     *     operationId="getStyleById",
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
     *         ref="#/components/schemas/StyleResource"
     *     )
     * )
     */
    public function show(Style $style)
    {
        return new StyleResource($style);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/admin/style/{id}",
     *     summary="Update style by id",
     *     operationId="updateStyle",
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
     *             ref="#/components/schemas/StyleResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/StyleRequest")
     * )
     */
    public function update(StyleRequest $request, Style $style)
    {
        $params = $request->validated();
        $this->formatParams($params);
        $style->update($params);

        return new StyleResource($style);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/admin/style/{id}",
     *     summary="Delete style by Id",
     *     operationId="deleteStyleById",
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
    public function destroy(Style $style)
    {
        $style->delete();

        return response()->json();
    }
}
