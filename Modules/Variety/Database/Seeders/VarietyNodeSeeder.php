<?php

namespace Modules\Variety\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Node\Constants\Variety\ManageVarietyNodeCodeConstants;
use Modules\Node\Service\ManageNodeGroupService;
use Modules\Node\Service\ManageNodeService;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Service\AdminRoleService;

class VarietyNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupService = ManageNodeGroupService::getInstance();
        $group = $groupService->updateOrCreate('綜藝管理', ManageVarietyNodeCodeConstants::MANAGE_VARIETY);
        if ($group) {
            $roleService = new AdminRoleService();
            $nodeService = ManageNodeService::getInstance();
            $nodeRead = $nodeService->edit(
                $group,
                '綜藝管理-讀取',
                ManageVarietyNodeCodeConstants::MANAGE_VARIETY_READ
            );
            if ($nodeRead) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeRead);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeRead);
            }
            $nodeCreate = $nodeService->edit(
                $group,
                '綜藝管理-新增',
                ManageVarietyNodeCodeConstants::MANAGE_VARIETY_CREATE
            );
            if ($nodeCreate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeCreate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeCreate);
            }
            $nodeUpdate = $nodeService->edit(
                $group,
                '綜藝管理-編輯',
                ManageVarietyNodeCodeConstants::MANAGE_VARIETY_UPDATE
            );
            if ($nodeUpdate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeUpdate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeUpdate);
            }
            $nodeDel = $nodeService->edit(
                $group,
                '綜藝管理-刪除',
                ManageVarietyNodeCodeConstants::MANAGE_VARIETY_DELETE
            );
            if ($nodeDel) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeDel);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeDel);
            }
        }
        //集數設定
        $groupService = ManageNodeGroupService::getInstance();
        $group = $groupService->updateOrCreate('綜藝管理-集數設定', ManageVarietyNodeCodeConstants::MANAGE_VARIETY_EPISODE);
        if ($group) {
            $roleService = new AdminRoleService();
            $nodeService = ManageNodeService::getInstance();
            $nodeRead = $nodeService->edit(
                $group,
                '綜藝管理-集數設定-讀取',
                ManageVarietyNodeCodeConstants::MANAGE_VARIETY_EPISODE_READ
            );
            if ($nodeRead) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeRead);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeRead);
            }
            $nodeCreate = $nodeService->edit(
                $group,
                '綜藝管理-集數設定-新增',
                ManageVarietyNodeCodeConstants::MANAGE_VARIETY_EPISODE_CREATE
            );
            if ($nodeCreate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeCreate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeCreate);
            }
            $nodeUpdate = $nodeService->edit(
                $group,
                '綜藝管理-集數設定-編輯',
                ManageVarietyNodeCodeConstants::MANAGE_VARIETY_EPISODE_UPDATE
            );
            if ($nodeUpdate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeUpdate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeUpdate);
            }
            $nodeDel = $nodeService->edit(
                $group,
                '綜藝管理-集數設定-刪除',
                ManageVarietyNodeCodeConstants::MANAGE_VARIETY_EPISODE_DELETE
            );
            if ($nodeDel) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeDel);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeDel);
            }
        }
    }
}
