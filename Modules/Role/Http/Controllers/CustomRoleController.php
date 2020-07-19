<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Role\Entities\Role;
use Modules\Role\Http\Requests\CustomRoleCreateRequest;
use Modules\Role\Http\Requests\CustomRoleEditRequest;
use Modules\Role\Http\Requests\PublicRoleDeleteRequest;
use Modules\Role\Service\CustomRoleMaintainService;

/**
 * 自定義角色
 * Class CustomRoleController
 * @package Modules\Role\Http\Controllers
 */
class CustomRoleController extends Controller
{
    /**
     * @param CustomRoleCreateRequest $request
     * @return Role
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function create(CustomRoleCreateRequest $request)
    {
        return CustomRoleMaintainService::getInstance()->create($request);
    }

    /**
     * @param CustomRoleEditRequest $request
     * @return Role|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function edit(CustomRoleEditRequest $request)
    {
        return CustomRoleMaintainService::getInstance()->edit($request);
    }

    /**
     * @param $id
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function delete($id)
    {
        $request = PublicRoleDeleteRequest::getHandle(compact('id'));

        return CustomRoleMaintainService::getInstance()->delete($request);
    }
}
