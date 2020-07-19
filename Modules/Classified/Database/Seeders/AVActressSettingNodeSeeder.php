<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 04:53
 */

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;

class AVActressSettingNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            \Modules\Video\Database\Seeders\AVActressSettingNodeSeeder::class,
            \Modules\Selfie\Database\Seeders\AVActressSettingNodeSeeder::class,
            \Modules\ShortFilm\Database\Seeders\AVActressSettingNodeSeeder::class,
            \Modules\Photograph\Database\Seeders\AVActressSettingNodeSeeder::class,
            \Modules\FeatureFilm\Database\Seeders\AVActressSettingNodeSeeder::class,
        ]);
    }
}
