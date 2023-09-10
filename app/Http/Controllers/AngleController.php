<?php

namespace App\Http\Controllers;

use App\AngleManager;
use App\Http\Requests\AngleRequest;
use App\Http\Resources\AngleResource;
use App\Models\Angle;

class AngleController extends Controller
{
    private const PER_PAGE = 20;

    public function index()
    {
        return AngleResource::collection(Angle::query()->paginate(self::PER_PAGE));
    }

    public function store(AngleRequest $request)
    {
        $angle = app(AngleManager::class)->create($request->validated());

        return new AngleResource($angle->load('imageMedia'));
    }

    public function show(Angle $angle)
    {
        return new AngleResource($angle);
    }

    public function update(AngleRequest $request, Angle $angle)
    {
        app(AngleManager::class, ['angle' => $angle])->update($request->validated());

        return new AngleResource($angle);
    }

    public function destroy(Angle $angle)
    {
        $angle->delete();

        return response()->json();
    }
}
