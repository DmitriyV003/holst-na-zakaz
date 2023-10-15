<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteRequest;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use App\SiteManager;

class SiteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/admin/site",
     *     summary="Returns paginated sites",
     *     operationId="getAllSites",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/SiteResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return SiteResource::collection(Site::with('fieldTypes')->paginate());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/admin/site",
     *     summary="Create site",
     *     operationId="storeSite",
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/SiteResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/SiteRequest")
     * )
     */
    public function store(SiteRequest $request)
    {
        $site = app(SiteManager::class, ['site' => null])->create($request->validated());
        return new SiteResource($site->load('fieldTypes'));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/admin/site/{id}",
     *     summary="Returns site by id",
     *     operationId="getSiteById",
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
     *         ref="#/components/schemas/SiteResource"
     *     )
     * )
     */
    public function show(Site $site)
    {
        return new SiteResource($site->load('fieldTypes'));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/admin/site/{id}",
     *     summary="Update site by id",
     *     operationId="updateSiteById",
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
     *             ref="#/components/schemas/SiteResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/SiteRequest")
     * )
     */
    public function update(SiteRequest $request, Site $site)
    {
        app(SiteManager::class, ['site' => $site])->update($request->validated());

        return new SiteResource($site->load('fieldTypes'));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/admin/site/{id}",
     *     summary="Delete site by id",
     *     operationId="deleteSiteById",
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
    public function destroy(Site $site)
    {
        $site->delete();

        return response()->json();
    }
}
