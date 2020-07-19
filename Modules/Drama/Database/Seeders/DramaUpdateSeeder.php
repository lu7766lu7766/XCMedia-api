<?php

namespace Modules\Drama\Database\Seeders;

use Illuminate\Database\Seeder;

class DramaUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UpdateDramaNodeSeederStep1::class,
            UpdateRegionSettingNodeSeederStep1::class,
            UpdateGenresSettingNodeSeederStep1::class,
            UpdateLanguageSettingNodeSeederStep1::class,
            UpdateYearsSettingNodeSeederStep1::class,
            UpdateSourceSettingNodeSeederStep1::class,
            UpdateTopicTypeNodeSeederStep1::class,
        ]);
    }
}
