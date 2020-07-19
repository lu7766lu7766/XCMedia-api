<?php

namespace Modules\Topic\Database\Seeders;

use Illuminate\Database\Seeder;

class TopicTypeNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Modules\Drama\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\Movie\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\Anime\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\Variety\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\FeatureFilm\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\ShortFilm\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\Selfie\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\Photograph\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\Video\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\Comic\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\Literature\Database\Seeders\TopicTypeNodeSeeder::class);
        $this->call(\Modules\Storytelling\Database\Seeders\TopicTypeNodeSeeder::class);
    }
}
