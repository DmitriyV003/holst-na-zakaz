<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteRequest;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use App\SiteManager;

class SiteController extends Controller
{
    public function index()
    {
        return SiteResource::collection(Site::with('fieldTypes')->get());
    }

    public function store(SiteRequest $request)
    {
        $site = app(SiteManager::class, ['site' => null])->create($request->validated());
        return new SiteResource($site->load('fieldTypes'));
    }

    public function show(Site $site)
    {
        return new SiteResource($site->load('fieldTypes'));
    }

    public function update(SiteRequest $request, Site $site)
    {
        app(SiteManager::class, ['site' => $site])->update($request->validated());

        return new SiteResource($site->load('fieldTypes'));
    }

    public function destroy(Site $site)
    {
        $site->delete();

        return response()->json();
    }
}
