<?php

namespace Modules\Literature\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Node\Constants\Literature\ManageLiteratureVolumeNodeCodeConstants;
use Modules\Node\Service\ManageNodeGroupService;
use Modules\Node\Service\ManageNodeService;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Service\AdminRoleService;

class LiteratureVolumeNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupService = ManageNodeGroupService::getInstance();
        $group = $groupService->updateOrCreate(
            '成人文學-文學管理-集數',
            ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME
        );
        if ($group) {
            $roleService = new AdminRoleService();
            $nodeService = ManageNodeService::getInstance();
            $nodeRead = $nodeService->edit(
                $group,
                '成人文學-文學管理-集數-讀取',
                ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_READ
            );
            if ($nodeRead) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeRead);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeRead);
            }
            $nodeCreate = $nodeService->edit(
                $group,
                '成人文學-文學管理-集數-新增',
                ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_CREATE
            );
            if ($nodeCreate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeCreate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeCreate);
            }
            $nodeUpdate = $nodeService->edit(
                $group,
                '成人文學-文學管理-集數-編輯',
                ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_UPDATE
            );
            if ($nodeUpdate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeUpdate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeUpdate);
            }
            $nodeDel = $nodeService->edit(
                $group,
                '成人文學-文學管理-集數-刪除',
                ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_DELETE
            );
            if ($nodeDel) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeDel);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeDel);
            }
        }
    }
}
