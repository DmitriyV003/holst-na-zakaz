<?php

namespace App\Http\Controllers;

use App\Http\Requests\AngleRequest;
use App\Http\Resources\AngleResource;
use App\Models\Angle;

class AngleController extends Controller
{
    public function index()
    {
        return AngleResource::collection(Angle::all());
    }

    public function store(AngleRequest $request)
    {
        return new AngleResource(Angle::create($request->validated()));
    }

    public function show(Angle $angle)
    {
        return new AngleResource($angle);
    }

    public function update(AngleRequest $request, Angle $angle)
    {
        $angle->update($request->validated());

        return new AngleResource($angle);
    }

    public function destroy(Angle $angle)
    {
        $angle->delete();

        return response()->json();
    }
}
