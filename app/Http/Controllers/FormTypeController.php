<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormTypeRequest;
use App\Http\Resources\FormTypeResource;
use App\Models\FormType;

class FormTypeController extends Controller
{
    public function index()
    {
        return FormTypeResource::collection(FormType::all());
    }

    public function store(FormTypeRequest $request)
    {
        return new FormTypeResource(FormType::create($request->validated()));
    }

    public function show(FormType $formType)
    {
        return new FormTypeResource($formType);
    }

    public function update(FormTypeRequest $request, FormType $formType)
    {
        $formType->update($request->validated());

        return new FormTypeResource($formType);
    }

    public function destroy(FormType $formType)
    {
        $formType->delete();

        return response()->json();
    }
}
