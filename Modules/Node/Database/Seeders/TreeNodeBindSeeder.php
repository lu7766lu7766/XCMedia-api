<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/5
 * Time: 下午 06:12
 */

namespace Modules\Node\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Modules\Node\Service\ManageNodeGroupService;
use Modules\Node\Service\ManageNodeService;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Service\AdminRoleService;

abstract class TreeNodeBindSeeder extends Seeder
{
    /**
     * 父節點名稱
     * @return string
     */
    abstract protected function parentName(): string;

    /**
     * 父節點代碼
     * @return string
     */
    abstract protected function parentCode(): string;

    /**
     * Run the nodes seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = ManageNodeGroupService::getInstance()->updateOrCreate($this->parentName(), $this->parentCode());
        if ($group) {
            $roleService = new AdminRoleService();
            $this->nodes()->map(function (string $name, string $code) use ($group, $roleService) {
                $node = ManageNodeService::getInstance()->edit(
                    $group,
                    $name,
                    $code
                );
                if ($node) {
                    $roleService->bindNode(RoleInherentConstants::ADMIN, $node);
                    $roleService->bindNode(RoleInherentConstants::SYSTEM_MANAGER, $node);
                }
            });
        }
    }

    /**
     * 子節點集合,key為子節點code,value為子節點名稱
     * nodes collect
     * node code put at key
     * node name put at value
     * @return Collection
     */
    abstract protected function nodes(): Collection;
}
