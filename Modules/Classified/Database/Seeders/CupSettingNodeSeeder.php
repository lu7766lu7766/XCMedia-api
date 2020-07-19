<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 下午 04:42
 */

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;

class CupSettingNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            \Modules\Video\Database\Seeders\CupSettingNodeSeeder::class,
            \Modules\FeatureFilm\Database\Seeders\CupSettingNodeSeeder::class,
            \Modules\Selfie\Database\Seeders\CupSettingNodeSeeder::class,
            \Modules\ShortFilm\Database\Seeders\CupSettingNodeSeeder::class,
            \Modules\Photograph\Database\Seeders\CupSettingNodeSeeder::class
        ]);
    }
}
