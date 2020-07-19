<?php

namespace Modules\Passport\Database\Seeders;

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;
use Modules\Account\Entities\Account;

class PassportDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param ClientRepository $clients
     * @return void
     */
    public function run(ClientRepository $clients)
    {
        // 官方 client
        $clients->createPasswordGrantClient(null, 'official app client', 'http://localhost');
        /** @var Account $admin */
        $admin = Account::where('account', 'admin')->first();
        // admin client (personal)
        $clients->createPersonalAccessClient($admin->getKey(), 'admin client', 'http://localhost');
    }
}
