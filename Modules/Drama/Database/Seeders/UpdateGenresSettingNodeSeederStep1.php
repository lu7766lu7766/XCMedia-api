<?php

namespace Modules\Drama\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Node\Constants\Drama\GenresSettingNodeCodeConstants;
use Modules\Node\Service\ManageNodeGroupService;
use Modules\Node\Service\ManageNodeService;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Service\AdminRoleService;

class UpdateGenresSettingNodeSeederStep1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupService = ManageNodeGroupService::getInstance();
        $group = $groupService->updateOrCreate('影音电视-类型设定', GenresSettingNodeCodeConstants::DRAMA_GENRES_SETTING);
        if ($group) {
            $roleService = new AdminRoleService();
            $nodeService = ManageNodeService::getInstance();
            $nodeRead = $nodeService->edit(
                $group,
                '影音电视-类型设定-读取',
                GenresSettingNodeCodeConstants::DRAMA_GENRES_SETTING_READ
            );
            if ($nodeRead) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeRead);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeRead);
            }
            $nodeCreate = $nodeService->edit(
                $group,
                '影音电视-类型设定-新增',
                GenresSettingNodeCodeConstants::DRAMA_GENRES_SETTING_CREATE
            );
            if ($nodeCreate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeCreate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeCreate);
            }
            $nodeUpdate = $nodeService->edit(
                $group,
                '影音电视-类型设定-编辑',
                GenresSettingNodeCodeConstants::DRAMA_GENRES_SETTING_UPDATE
            );
            if ($nodeUpdate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeUpdate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeUpdate);
            }
            $nodeDel = $nodeService->edit(
                $group,
                '影音电视-类型设定-删除',
                GenresSettingNodeCodeConstants::DRAMA_GENRES_SETTING_DELETE
            );
            if ($nodeDel) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeDel);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeDel);
            }
        }
    }
}
