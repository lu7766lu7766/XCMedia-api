<?php

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;

class GenresSettingNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Modules\Movie\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\Anime\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\Drama\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\Variety\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\FeatureFilm\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\ShortFilm\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\Selfie\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\Photograph\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\Video\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\Comic\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\Literature\Database\Seeders\GenresSettingNodeSeeder::class);
        $this->call(\Modules\Storytelling\Database\Seeders\GenresSettingNodeSeeder::class);
    }
}

