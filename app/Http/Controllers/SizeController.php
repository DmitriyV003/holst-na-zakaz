<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Http\Resources\SizeResource;
use App\Models\Size;

class SizeController extends Controller
{
    public function index()
    {
        return SizeResource::collection(Size::all());
    }

    public function store(SizeRequest $request)
    {
        return new SizeResource(Size::create($request->validated()));
    }

    public function show(Size $size)
    {
        return new SizeResource($size);
    }

    public function update(SizeRequest $request, Size $size)
    {
        $size->update($request->validated());

        return new SizeResource($size);
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return response()->json();
    }
}
