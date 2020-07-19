<?php

namespace Modules\Advertisement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Advertisement\Entities\AdvertisementType;

class AdvertisementTypeUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizeHint = [
            '1920 x 550',
            '1140 x 150',
            '920 x 120',
            '920 x 120',
            '270 x 220',
            '840 x 110'
        ];
        $adType = new AdvertisementType();
        $typeCollection = $adType->get();
        $typeCollection->each(function (AdvertisementType $item, $key) use ($sizeHint) {
            $item->size_hint = $sizeHint[$key];
            $item->save();
        });
    }
}
