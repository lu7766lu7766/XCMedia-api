<?php

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;

class LanguageSettingNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Modules\Movie\Database\Seeders\LanguageSettingNodeSeeder::class);
        $this->call(\Modules\Drama\Database\Seeders\LanguageSettingNodeSeeder::class);
        $this->call(\Modules\Anime\Database\Seeders\LanguageSettingNodeSeeder::class);
        $this->call(\Modules\Variety\Database\Seeders\LanguageSettingNodeSeeder::class);
    }
}
