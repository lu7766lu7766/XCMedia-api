<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/9
 * Time: 上午 11:01
 */

namespace Modules\Role\Service;

use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Entities\Role;
use Modules\Role\Http\Requests\CustomRoleCreateRequest;
use Modules\Role\Http\Requests\CustomRoleEditRequest;
use Modules\Role\Http\Requests\PublicRoleDeleteRequest;
use Modules\Role\Repository\PublicRoleRepo;
use XC\Independent\Kit\Support\Traits\Pattern\Singleton;

class CustomRoleMaintainService
{
    use Singleton;
    /**
     * @var PublicRoleRepo
     */
    protected $repo = null;

    protected function init()
    {
        $this->repo = $this->repo ?: app(PublicRoleRepo::class);
    }

    /**
     * @param CustomRoleCreateRequest $request
     * @return Role
     * @throws ApiErrorCodeException
     */
    public function create(CustomRoleCreateRequest $request)
    {
        $role = new Role();
        $result = $this->repo->save(
            [
                'display_name' => $request->getName(),
                'description'  => $request->getDescription(),
                'code'         => RoleInherentConstants::CUSTOM,
                'enable'       => $request->getEnable()
            ],
            $role
        );
        if (!$result) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $role;
    }

    /**
     * @param CustomRoleEditRequest $request
     * @return Role
     * @throws ApiErrorCodeException
     */
    public function edit(CustomRoleEditRequest $request)
    {
        $role = $this->repo->findByCode($request->getId(), RoleInherentConstants::CUSTOM);
        if (is_null($role)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        $this->repo->save(
            [
                'display_name' => $request->getName(),
                'description'  => $request->getDescription(),
                'code'         => RoleInherentConstants::CUSTOM,
                'enable'       => $request->getEnable()
            ],
            $role
        );

        return $role;
    }

    /**
     * True is delete ,otherwise false.
     * @param PublicRoleDeleteRequest $request
     * @return int
     */
    public function delete(PublicRoleDeleteRequest $request)
    {
        return $this->repo->deleteByCode($request->getId(), RoleInherentConstants::CUSTOM);
    }
}
