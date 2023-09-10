<?php

namespace App;

use App\Models\Media;
use App\Models\Style;
use DB;

class StyleManager
{
    private ?Style $style;

    public function create(array $params): Style
    {
        $this->style = app(Style::class)->fill(collect($params)->except('media_ids')->toArray());
        DB::transaction(function () use ($params) {
            $this->style->save();
            if (isset($params['media_ids'])) {
                $this->style->images()->saveMany(Media::find($params['media_ids']));
            }
        });

        return $this->style;
    }
}
