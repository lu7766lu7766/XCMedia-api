<?php

namespace Modules\Collector\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Collector\Entities\CollectorPlatform;

class CollectorPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platform = collect([
            [
                'title'  => '爱奇艺',
                'code'   => 'qiyi',
                'status' => NYEnumConstants::YES,
            ],
            [
                'title'  => '腾讯',
                'code'   => 'qq',
                'status' => NYEnumConstants::YES,
            ],
            [
                'title'  => '搜狐',
                'code'   => 'sohu',
                'status' => NYEnumConstants::YES,
            ],
            [
                'title'  => '芒果',
                'code'   => 'mgtv',
                'status' => NYEnumConstants::YES,
            ],
            [
                'title'  => '优酷',
                'code'   => 'youku',
                'status' => NYEnumConstants::YES,
            ]
        ]);
        $platform->map(function ($platform) {
            CollectorPlatform::query()->firstOrCreate($platform);
        });
    }
}
