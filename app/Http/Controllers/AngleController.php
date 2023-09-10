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
        return AngleResource::collection(Angle::query()->with('imageMedia')->paginate(self::PER_PAGE));
    }

    public function store(AngleRequest $request)
    {
        $params = $request->validated();
        $this->formatParams($params);
        $angle = app(AngleManager::class, ['angle' => null])->create($params);

        return new AngleResource($angle->load('imageMedia'));
    }

    public function show(Angle $angle)
    {
        return new AngleResource($angle);
    }

    public function update(AngleRequest $request, Angle $angle)
    {
        $params = $request->validated();
        $this->formatParams($params);
        app(AngleManager::class, ['angle' => $angle])->update($params);

        return new AngleResource($angle);
    }

    public function destroy(Angle $angle)
    {
        $angle->delete();

        return response()->json();
    }

    private function formatParams(array &$params)
    {
        if (isset($params['price'])) {
            $params['price'] = money_parse($params['price']);
        }
        if (isset($params['old_price'])) {
            $params['old_price'] = money_parse($params['old_price']);
        }
    }
}
