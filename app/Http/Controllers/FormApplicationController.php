<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormApplicationRequest;
use App\Http\Resources\FormApplicationResource;
use App\Models\FormApplication;

class FormApplicationController extends Controller
{
    private const PER_PAGE = 20;

    public function index()
    {
        return FormApplicationResource::collection(FormApplication::query()->paginate(self::PER_PAGE));
    }

    public function store(FormApplicationRequest $request)
    {
        return new FormApplicationResource(FormApplication::create($request->validated()));
    }

    public function update(FormApplicationRequest $request, FormApplication $formApplication)
    {
        $formApplication->update($request->validated());

        return new FormApplicationResource($formApplication);
    }
}
