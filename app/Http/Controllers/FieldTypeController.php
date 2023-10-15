<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldTypeRequest;
use App\Http\Resources\FieldTypeResource;
use App\Models\FieldType;

class FieldTypeController extends Controller
{
    public function index()
    {
        return FieldTypeResource::collection(FieldType::all());
    }

    public function store(FieldTypeRequest $request)
    {
        return new FieldTypeResource(FieldType::create($request->validated()));
    }

    public function show(FieldType $filedType)
    {
        return new FieldTypeResource($filedType);
    }

    public function update(FieldTypeRequest $request, FieldType $filedType)
    {
        $filedType->update($request->validated());

        return new FieldTypeResource($filedType);
    }

    public function destroy(FieldType $filedType)
    {
        $filedType->delete();

        return response()->json();
    }
}
