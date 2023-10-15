<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldTypeRequest;
use App\Http\Resources\FieldTypeResource;
use App\Models\FieldType;

class FieldTypeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/admin/field-type",
     *     summary="Returns paginated filed types",
     *     operationId="getAllFieldTypes",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/FieldTypeResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return FieldTypeResource::collection(FieldType::all());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/admin/field-type",
     *     summary="Create field-type",
     *     operationId="storeFieldType",
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/FieldTypeResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/FieldTypeRequest")
     * )
     */
    public function store(FieldTypeRequest $request)
    {
        return new FieldTypeResource(FieldType::create($request->validated()));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/admin/field-type/{id}",
     *     summary="Returns field-type by id",
     *     operationId="getFeildTypeById",
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
     *         ref="#/components/schemas/FieldTypeResource"
     *     )
     * )
     */
    public function show(FieldType $filedType)
    {
        return new FieldTypeResource($filedType);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/admin/field-type/{id}",
     *     summary="Update angle by id",
     *     operationId="updateFieldType",
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
     *             ref="#/components/schemas/FieldTypeResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/FieldTypeRequest")
     * )
     */
    public function update(FieldTypeRequest $request, FieldType $filedType)
    {
        $filedType->update($request->validated());

        return new FieldTypeResource($filedType);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/admin/field-type/{id}",
     *     summary="Delete field type by id",
     *     operationId="deleteFieldType",
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
    public function destroy(FieldType $filedType)
    {
        $filedType->delete();

        return response()->json();
    }
}
