<?php

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;

class YearsSettingNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Modules\Movie\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\Drama\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\Anime\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\Variety\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\FeatureFilm\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\ShortFilm\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\Selfie\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\Photograph\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\Video\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\Comic\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\Literature\Database\Seeders\YearsSettingNodeSeeder::class);
        $this->call(\Modules\Storytelling\Database\Seeders\YearsSettingNodeSeeder::class);
    }
}
