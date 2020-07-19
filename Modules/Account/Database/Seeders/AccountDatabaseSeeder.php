<?php

namespace Modules\Account\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Account\Service\AdminAccountService;
use Modules\Role\Constants\RoleInherentConstants;

class AccountDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Throwable
     */
    public function run()
    {
        $service = \App::make(AdminAccountService::class);
        $service->createAdmin();
        $param = [
            'account'      => '',
            'display_name' => '管理員',
            'mail'         => '@manager.cc',
            'phone'        => '7997979979',
            'status'       => 'enable'
        ];
        $addUserList = [
            'aaron',
            'jacc',
            'funny',
            'derek',
            'xced',
            'arxing',
            'water',
            'ph',
            'rock',
            'edward'
        ];
        foreach ($addUserList as $user) {
            $password = $user . '666';
            $param['account'] = $user;
            $param['display_name'] = $user . '系统管理员';
            $param['mail'] = $user . '@manager.cc';
            $service->create($param, $password, RoleInherentConstants::SYSTEM_MANAGER);
        }
    }
}
