<?php

namespace App\Http\Controllers;

use App\FormApplicationManager;
use App\Http\Requests\FormApplicationRequest;
use App\Http\Resources\FormApplicationResource;
use App\Models\FormApplication;
use OpenApi\Annotations as OA;

class FormApplicationController extends Controller
{
    private const PER_PAGE = 20;

    /**
     * @OA\Get(
     *     path="/api/v1/admin/form-application",
     *     summary="Returns paginated form applicaions",
     *     operationId="getAllFormApplications",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/FormApplicationResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return FormApplicationResource::collection(FormApplication::query()->paginate(self::PER_PAGE));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/form-application",
     *     summary="Returns paginated form applicaions",
     *     operationId="storeFormAppication",
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/FormApplicationResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/FormApplicationRequest")
     * )
     */
    public function store(FormApplicationRequest $request)
    {
        $application = app(FormApplicationManager::class, ['formApplication' => null])
            ->create($request->validated());
        return new FormApplicationResource($application);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/form-application/{id}",
     *     summary="Returns paginated form applicaions",
     *     operationId="updateFormAppication",
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
     *             ref="#/components/schemas/FormApplicationResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/FormApplicationRequest")
     * )
     */
    public function update(FormApplicationRequest $request, FormApplication $formApplication)
    {
        $formApplication->update($request->validated());

        return new FormApplicationResource($formApplication);
    }
}
