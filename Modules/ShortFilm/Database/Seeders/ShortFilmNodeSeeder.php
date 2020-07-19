<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 03:38
 */

namespace Modules\ShortFilm\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Node\Constants\ShortFilm\ManageShortFilmNodeCodeConstants;
use Modules\Node\Service\ManageNodeGroupService;
use Modules\Node\Service\ManageNodeService;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Service\AdminRoleService;

class ShortFilmNodeSeeder extends Seeder
{
    /** @var AdminRoleService $adminRoleService */
    private $adminRoleService;

    public function __construct(AdminRoleService $adminRoleService)
    {
        $this->adminRoleService = $adminRoleService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupService = ManageNodeGroupService::getInstance();
        $group = $groupService->updateOrCreate(
            '成人短片-短片管理',
            ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM
        );
        if ($group) {
            $nodeService = ManageNodeService::getInstance();
            $nodeRead = $nodeService->edit(
                $group,
                '成人短片-短片管理-讀取',
                ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_READ
            );
            if ($nodeRead) {
                $this->adminRoleService->bindNode(RoleInherentConstants::ADMIN, $nodeRead);
                $this->adminRoleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeRead);
            }
            $nodeAdd = $nodeService->edit(
                $group,
                '成人短片-短片管理-新增',
                ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_CREATE
            );
            if ($nodeAdd) {
                $this->adminRoleService->bindNode(RoleInherentConstants::ADMIN, $nodeAdd);
                $this->adminRoleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeAdd);
            }
            $nodeEdit = $nodeService->edit(
                $group,
                '成人短片-短片管理-編輯',
                ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_UPDATE
            );
            if ($nodeEdit) {
                $this->adminRoleService->bindNode(RoleInherentConstants::ADMIN, $nodeEdit);
                $this->adminRoleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeEdit);
            }
            $nodeDelete = $nodeService->edit(
                $group,
                '成人短片-短片管理-刪除',
                ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_DELETE
            );
            if ($nodeDelete) {
                $this->adminRoleService->bindNode(RoleInherentConstants::ADMIN, $nodeDelete);
                $this->adminRoleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeDelete);
            }
            $nodeVideo = $nodeService->edit(
                $group,
                '成人短片-短片管理-影片管理',
                ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_VIDEO
            );
            if ($nodeVideo) {
                $this->adminRoleService->bindNode(RoleInherentConstants::ADMIN, $nodeVideo);
                $this->adminRoleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $nodeVideo);
            }
        }
    }
}
