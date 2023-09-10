<?php

namespace App;

use App\Models\FormApplication;
use App\Models\Media;
use DB;

class FormApplicationManager
{
    private ?FormApplication $formApplication;

    public function __construct(?FormApplication $formApplication)
    {
        $this->formApplication = $formApplication;
    }

    public function create(array $params): FormApplication
    {
        DB::transaction(function () use ($params) {
            $this->formApplication = FormApplication::create(collect($params)->except('media_id')->toArray());
            if (isset($params['media_id'])) {
                $this->formApplication->imageMedia()->save(Media::findOrFail($params['media_id']));
            }
        });

        return $this->formApplication;
    }
}
