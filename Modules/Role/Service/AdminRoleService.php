<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/6/20
 * Time: 下午 05:27
 */

namespace Modules\Role\Service;

use Modules\Base\Constants\NYEnumConstants;
use Modules\Node\Entities\Node;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Entities\Role;
use Modules\Role\Repository\AdminRoleRepo;
use Modules\Role\Repository\RoleNodeRepo;

class AdminRoleService
{
    /**
     * @var AdminRoleRepo
     */
    private $repo;
    /**
     * @var RoleNodeRepo
     */
    private $roleNodeRepo;

    public function __construct()
    {
        $this->repo = \App::make(AdminRoleRepo::class);
        $this->roleNodeRepo = \App::make(RoleNodeRepo::class);
    }

    /**
     * @param string $displayName 呈現文字
     * @param string $code 代碼
     * @param string $public see also to know more info. 是否公開取用.
     * @param string $enable see also to know more info. 是否啟用.
     * @return Role
     * @see NYEnumConstants
     */
    public function edit(
        string $displayName,
        string $code,
        string $public = 'Y',
        string $enable = 'Y'
    ) {
        $role = null;
        if (RoleInherentConstants::isValidValue($code)) {
            $role = $this->repo->firstByCode($code) ?? new Role();
            $this->repo->save(
                [
                    'display_name' => $displayName,
                    'code'         => $code,
                    'public'       => $public,
                    'enable'       => $enable
                ],
                $role
            );
        }

        return $role;
    }

    /**
     * @param string $code
     * @param Node $node
     * @return Role|null
     */
    public function bindNode(string $code, Node $node)
    {
        $role = $this->repo->firstByCode($code);
        if (!is_null($role)) {
            $this->roleNodeRepo->bindNode($role, $node);
        }

        return $role;
    }
}
