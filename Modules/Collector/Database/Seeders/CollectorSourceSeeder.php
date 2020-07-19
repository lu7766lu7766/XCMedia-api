<?php

namespace Modules\Collector\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Collector\Entities\CollectorSource;
use Modules\Collector\Entities\MacCMS\MacCollect;

class CollectorSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $source = MacCollect::where('collect_type', 1)->get();
        $source->map(function (MacCollect $collect) {
            $attributes = [
                'id'     => $collect->collect_id,
                'title'  => $collect->collect_name,
                'url'    => $collect->collect_url,
                'status' => NYEnumConstants::YES
            ];

            return CollectorSource::query()->firstOrCreate($attributes);
        });
    }
}
