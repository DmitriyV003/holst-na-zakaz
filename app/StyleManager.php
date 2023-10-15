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
        $this->style = app(Style::class)->fill(collect($params)->except('media')->toArray());
        DB::transaction(function () use ($params) {
            $this->style->save();
            if (isset($params['media'])) {
                collect($params['media'])->each(function ($item) {
                    $styleImage = $this->style->styleImages()->create($item);
                    $styleImage->imageMedia()->save(Media::findOrFail($item['media_id']));
                });
            }
        });

        return $this->style;
    }
}
