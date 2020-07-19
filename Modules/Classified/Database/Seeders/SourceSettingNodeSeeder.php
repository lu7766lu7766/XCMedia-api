<?php

namespace Modules\Classified\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SourceSettingNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $this->call(\Modules\Movie\Database\Seeders\SourceSettingNodeSeeder::class);
         $this->call(\Modules\Anime\Database\Seeders\SourceSettingNodeSeeder::class);
         $this->call(\Modules\Drama\Database\Seeders\SourceSettingNodeSeeder::class);
         $this->call(\Modules\Variety\Database\Seeders\SourceSettingNodeSeeder::class);
    }
}
