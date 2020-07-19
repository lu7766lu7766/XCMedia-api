<?php

namespace Modules\Role\Http\Controllers;

use Modules\Base\Http\Controllers\BaseController;
use Modules\Role\Entities\Role;
use Modules\Role\Http\Requests\PublicRoleAuthorizationRequest;
use Modules\Role\Http\Requests\PublicRoleInfoRequest;
use Modules\Role\Http\Requests\PublicRoleListRequest;
use Modules\Role\Http\Requests\PublicRoleNodeMapRequest;
use Modules\Role\Service\PublicRoleService;

class PublicRoleController extends BaseController
{
    /**
     * 角色列表
     * @param PublicRoleListRequest $request
     * @return array
     */
    public function index(PublicRoleListRequest $request)
    {
        return \App::make(PublicRoleService::class)->getList($request);
    }

    /**
     * 角色總數
     * @param PublicRoleListRequest $request
     * @return int
     */
    public function total(PublicRoleListRequest $request)
    {
        return \App::make(PublicRoleService::class)->total($request);
    }

    /**
     * @param int $id
     * @return Role|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function info($id)
    {
        $request = PublicRoleInfoRequest::getHandle(compact('id'));

        return \App::make(PublicRoleService::class)->find($request);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Node\Entities\NodeGroup[]
     */
    public function authorizedNodes()
    {
        return \App::make(PublicRoleService::class)->authorizedNodes();
    }

    /**
     * @param PublicRoleNodeMapRequest $request
     * @return array
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function nodeMap(PublicRoleNodeMapRequest $request)
    {
        $service = \App::make(PublicRoleService::class);

        return $service->publicNodeMap($request)->all();
    }

    /**
     * @param PublicRoleAuthorizationRequest $request
     * @return array
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function authorization(PublicRoleAuthorizationRequest $request)
    {
        $service = \App::make(PublicRoleService::class);

        return $service->refreshPublicNodes($request);
    }
}
