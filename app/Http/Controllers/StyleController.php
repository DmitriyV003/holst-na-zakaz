<?php

namespace App\Http\Controllers;

use App\Http\Requests\StyleRequest;
use App\Http\Resources\StyleResource;
use App\Models\Style;

class StyleController extends Controller
{
    public function index()
    {
        return StyleResource::collection(Style::all());
    }

    public function store(StyleRequest $request)
    {
        return new StyleResource(Style::create($request->validated()));
    }

    public function show(Style $style)
    {
        return new StyleResource($style);
    }

    public function update(StyleRequest $request, Style $style)
    {
        $style->update($request->validated());

        return new StyleResource($style);
    }

    public function destroy(Style $style)
    {
        $style->delete();

        return response()->json();
    }
}
