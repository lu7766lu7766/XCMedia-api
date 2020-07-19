<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/7
 * Time: 下午 01:56
 */

namespace Modules\FeatureFilm\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Node\Constants\FeatureFilm\TopicTypeNodeCodeConstants;
use Modules\Node\Service\ManageNodeGroupService;
use Modules\Node\Service\ManageNodeService;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Service\AdminRoleService;

class TopicTypeNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupService = ManageNodeGroupService::getInstance();
        $group = $groupService->updateOrCreate('成人長片-專題分類', TopicTypeNodeCodeConstants::FEATURE_FILM_TOPIC_TYPE);
        if ($group) {
            $roleService = new AdminRoleService();
            $nodeService = ManageNodeService::getInstance();
            $nodeRead = $nodeService->edit(
                $group,
                '成人長片-專題分類-讀取',
                TopicTypeNodeCodeConstants::FEATURE_FILM_TOPIC_TYPE_READ
            );
            if ($nodeRead) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeRead);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeRead);
            }
            $nodeCreate = $nodeService->edit(
                $group,
                '成人長片-專題分類-新增',
                TopicTypeNodeCodeConstants::FEATURE_FILM_TOPIC_TYPE_CREATE
            );
            if ($nodeCreate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeCreate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeCreate);
            }
            $nodeUpdate = $nodeService->edit(
                $group,
                '成人長片-專題分類-編輯',
                TopicTypeNodeCodeConstants::FEATURE_FILM_TOPIC_TYPE_UPDATE
            );
            if ($nodeUpdate) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeUpdate);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeUpdate);
            }
            $nodeDel = $nodeService->edit(
                $group,
                '成人長片-專題分類-刪除',
                TopicTypeNodeCodeConstants::FEATURE_FILM_TOPIC_TYPE_DELETE
            );
            if ($nodeDel) {
                $roleService->bindNode(RoleInherentConstants::ADMIN, $nodeDel);
                $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeDel);
            }
        }
    }
}

