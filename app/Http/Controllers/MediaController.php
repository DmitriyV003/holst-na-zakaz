<?php

namespace App\Http\Controllers;

use App\Http\Requests\AngleRequest;
use App\Http\Requests\MediaRequest;
use App\Http\Resources\AngleResource;
use App\MediaManager;
use App\Models\Angle;
use App\Models\User;

class MediaController extends Controller
{
    public function store(MediaRequest $request)
    {
        $media = app(MediaManager::class)
            ->putUploadedFile(User::find(1), collect($request->file())->flatten()->first());

        return response()->json($media->id);
    }
}
