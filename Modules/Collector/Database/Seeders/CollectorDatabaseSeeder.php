<?php

namespace Modules\Collector\Database\Seeders;

use Illuminate\Database\Seeder;

class CollectorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CollectorSourceSeeder::class,
            CollectorTypeSeeder::class,
            CollectorPlatformSeeder::class,
            CollectorNodeSeeder::class
        ]);
    }
}
