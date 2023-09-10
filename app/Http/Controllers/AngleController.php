<?php

namespace App\Http\Controllers;

use App\Http\Requests\AngleRequest;
use App\Http\Resources\AngleResource;
use App\MediaManager;
use App\Models\Angle;
use App\Models\Media;

class AngleController extends Controller
{
    private const PER_PAGE = 20;

    public function index()
    {
        return AngleResource::collection(Angle::query()->paginate(self::PER_PAGE));
    }

    public function store(AngleRequest $request)
    {
        $angle = Angle::create($request->validated());
        app(MediaManager::class, ['media' => Media::findOrFail($request->input('media_id'))])
            ->updateRelation($angle);
        return new AngleResource($angle->load('imageMedia'));
    }

    public function show(Angle $angle)
    {
        return new AngleResource($angle);
    }

    public function update(AngleRequest $request, Angle $angle)
    {
        $angle->update($request->validated());
        app(MediaManager::class, ['media' => Media::findOrFail($request->input('media_id'))])
            ->updateRelation($angle);

        return new AngleResource($angle);
    }

    public function destroy(Angle $angle)
    {
        $angle->delete();

        return response()->json();
    }
}
