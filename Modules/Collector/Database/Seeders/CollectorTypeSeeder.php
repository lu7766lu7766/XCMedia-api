<?php

namespace Modules\Collector\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Collector\Entities\CollectorType;
use Modules\Collector\Entities\MacCMS\MacType;

class CollectorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $source = MacType::where('type_mid', 1)->get();
        $source->map(function (MacType $collect) {
            $attributes = [
                'id'     => $collect->type_id,
                'title'  => $collect->type_name === '连续剧' ? '电视剧' : $collect->type_name,
                'code'   => $this->formatCode($collect->type_name),
                'status' => NYEnumConstants::YES
            ];

            return CollectorType::query()->firstOrCreate($attributes);
        });
    }

    /**
     * @param string $typeName
     * @return string
     */
    private function formatCode(string $typeName)
    {
        $type = [
            '电影'  => ClassifiedConstant::MOVIE,
            '连续剧' => ClassifiedConstant::DRAMA,
            '综艺'  => ClassifiedConstant::VARIETY,
            '动漫'  => ClassifiedConstant::ANIME,
        ];

        return $type[$typeName];
    }
}
