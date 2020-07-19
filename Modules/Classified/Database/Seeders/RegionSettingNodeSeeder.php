<?php

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;

class RegionSettingNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Modules\Anime\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\Comic\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\Drama\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\FeatureFilm\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\Literature\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\Movie\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\Photograph\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\Selfie\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\ShortFilm\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\Storytelling\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\Variety\Database\Seeders\RegionSettingNodeSeeder::class);
        $this->call(\Modules\Video\Database\Seeders\RegionSettingNodeSeeder::class);
    }
}
