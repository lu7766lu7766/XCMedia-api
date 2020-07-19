<?php

namespace Modules\Advertisement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Advertisement\Entities\AdvertisementType;

class AdvertisementTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            ['name' => '首頁-輪播區塊'],
            ['name' => '首頁-分隔區塊'],
            ['name' => '列表-上方區塊'],
            ['name' => '列表-下方區塊'],
            ['name' => '內頁-右方區塊'],
            ['name' => '內頁-分隔區塊']
        ];
        $adType = new AdvertisementType($type);
        $adType->insert($type);
    }
}
