<?php

namespace App;

use App\Models\Site;
use DB;

class SiteManager
{
    private ?Site $site;

    public function __construct(?Site $site = null)
    {
        $this->site = $site;
    }

    public function create(array $params): Site
    {
        DB::transaction(function () use ($params) {
            $this->site = app(Site::class)->fill($params);
            $this->site->save();
            $this->syncFields($params['fields']);
        });

        return $this->site;
    }

    public function update(array $params): Site
    {
        DB::transaction(function () use ($params) {
            $this->site->update($params);
            $this->syncFields($params['fields']);
        });

        return $this->site;
    }

    private function syncFields(array $fields): void
    {
        $typesValues = collect($fields['fields'])->mapWithKeys(function ($item) {
            return [
                $item['field_id'] =>
                    [
                        'value' => $item['value'],
                        'location' => $item['location'],
                    ],
            ];
        });
        $this->site->fieldTypes()->sync($typesValues->all());
    }
}
