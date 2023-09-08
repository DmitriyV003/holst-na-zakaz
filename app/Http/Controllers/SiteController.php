<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteRequest;
use App\Http\Resources\SiteResource;
use App\Models\Site;

class SiteController extends Controller
{
    public function index()
    {
        return SiteResource::collection(Site::all());
    }

    public function store(SiteRequest $request)
    {
        return new SiteResource(Site::create($request->validated()));
    }

    public function show(Site $site)
    {
        return new SiteResource($site);
    }

    public function update(SiteRequest $request, Site $site)
    {
        $site->update($request->validated());

        return new SiteResource($site);
    }

    public function destroy(Site $site)
    {
        $site->delete();

        return response()->json();
    }
}
