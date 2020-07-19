<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Service\AdminRoleService;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new AdminRoleService();
        $service->edit('超級管理員', RoleInherentConstants::ADMIN, NYEnumConstants::NO);
        $service->edit('系統管理員', RoleInherentConstants::SYSTEM_MANAGER);
    }
}
