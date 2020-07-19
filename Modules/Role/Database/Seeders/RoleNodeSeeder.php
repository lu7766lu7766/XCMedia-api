<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Node\Constants\NodeCodeConstants;
use Modules\Node\Service\ManageNodeGroupService;
use Modules\Node\Service\ManageNodeService;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Service\AdminRoleService;

class RoleNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupService = ManageNodeGroupService::getInstance();
        $group = $groupService->updateOrCreate('角色管理', NodeCodeConstants::ROLE_CUSTOM_MANAGE);
        if ($group) {
            $roleService = new AdminRoleService();
            $nodeService = ManageNodeService::getInstance();
            $nodeRead = $nodeService->edit(
                $group,
                '角色管理-讀取',
                NodeCodeConstants::ROLE_CUSTOM_MANAGE_READ
            );
            if ($nodeRead) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeRead);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeRead);
            }
            $nodeCreate = $nodeService->edit(
                $group,
                '角色管理-新增',
                NodeCodeConstants::ROLE_CUSTOM_MANAGE_CREATE
            );
            if ($nodeCreate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeCreate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeCreate);
            }
            $nodeUpdate = $nodeService->edit(
                $group,
                '角色管理-編輯',
                NodeCodeConstants::ROLE_CUSTOM_MANAGE_UPDATE
            );
            if ($nodeUpdate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeUpdate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeUpdate);
            }
            $nodeDel = $nodeService->edit(
                $group,
                '角色管理-刪除',
                NodeCodeConstants::ROLE_CUSTOM_MANAGE_DELETE
            );
            if ($nodeDel) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeDel);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeDel);
            }
            $nodePermission = $nodeService->edit(
                $group,
                '角色管理-權限',
                NodeCodeConstants::ROLE_PUBLIC_AUTHORIZATION
            );
            if ($nodePermission) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodePermission);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodePermission);
            }
        }
    }
}
