<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTypeRequest;
use App\Http\Resources\FormTypeResource;
use App\Models\FormType;

class FormTypeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/form-type",
     *     summary="Returns paginated form types",
     *     operationId="getAllFormTypes",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/FormTypeResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return FormTypeResource::collection(FormType::all());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/admin/form-type",
     *     summary="Create angle",
     *     operationId="storeFormType",
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/FormTypeResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/FormTypeRequest")
     * )
     */
    public function store(FormTypeRequest $request)
    {
        return new FormTypeResource(FormType::create($request->validated()));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/admin/form-type/{id}",
     *     summary="Returns angle by id",
     *     operationId="getFormTypeById",
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
     *         ref="#/components/schemas/FormTypeResource"
     *     )
     * )
     */
    public function show(FormType $formType)
    {
        return new FormTypeResource($formType);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/admin/form-type/{id}",
     *     summary="Update angle by id",
     *     operationId="updateFormTypeById",
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
     *             ref="#/components/schemas/FormTypeResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/FormTypeRequest")
     * )
     */
    public function update(FormTypeRequest $request, FormType $formType)
    {
        $formType->update($request->validated());

        return new FormTypeResource($formType);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/admin/form-type/{id}",
     *     summary="Delete form type by id",
     *     operationId="deleteFormTypeById",
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
    public function destroy(FormType $formType)
    {
        $formType->delete();

        return response()->json();
    }
}
