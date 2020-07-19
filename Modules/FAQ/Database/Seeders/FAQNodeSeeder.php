<?php

namespace Modules\FAQ\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Node\Constants\FAQNodeCodeConstants;
use Modules\Node\Service\ManageNodeGroupService;
use Modules\Node\Service\ManageNodeService;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Service\AdminRoleService;

class FAQNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupService = ManageNodeGroupService::getInstance();
        $group = $groupService->updateOrCreate('常見問題管理', FAQNodeCodeConstants::MANAGE_FAQ);
        if ($group) {
            $roleService = new AdminRoleService();
            $nodeService = ManageNodeService::getInstance();
            $nodeRead = $nodeService->edit(
                $group,
                '常見問題管理-讀取',
                FAQNodeCodeConstants::MANAGE_FAQ_READ
            );
            if ($nodeRead) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeRead);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeRead);
            }
            $nodeCreate = $nodeService->edit(
                $group,
                '常見問題管理-新增',
                FAQNodeCodeConstants::MANAGE_FAQ_CREATE
            );
            if ($nodeCreate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeCreate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeCreate);
            }
            $nodeUpdate = $nodeService->edit(
                $group,
                '常見問題管理-編輯',
                FAQNodeCodeConstants::MANAGE_FAQ_UPDATE
            );
            if ($nodeUpdate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeUpdate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeUpdate);
            }
            $nodeDel = $nodeService->edit(
                $group,
                '常見問題管理-刪除',
                FAQNodeCodeConstants::MANAGE_FAQ_DELETE
            );
            if ($nodeDel) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeDel);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeDel);
            }
        }
    }
}
