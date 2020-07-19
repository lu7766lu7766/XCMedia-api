<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/9
 * Time: 上午 11:01
 */

namespace Modules\Role\Service;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Node\Contract\INodeProvider;
use Modules\Node\Entities\NodeGroup;
use Modules\Role\Entities\Role;
use Modules\Role\Http\Requests\PublicRoleAuthorizationRequest;
use Modules\Role\Http\Requests\PublicRoleInfoRequest;
use Modules\Role\Http\Requests\PublicRoleListRequest;
use Modules\Role\Http\Requests\PublicRoleNodeMapRequest;
use Modules\Role\Repository\PublicRoleRepo;
use Modules\Role\Repository\RoleNodeRepo;

class PublicRoleService
{
    /**
     * @var PublicRoleRepo
     */
    protected $repo;
    /**
     * @var RoleNodeRepo
     */
    private $roleNodeRepo;
    /**
     * @var INodeProvider
     */
    private $nodeProvider;

    public function __construct(INodeProvider $provider)
    {
        $this->repo = \App::make(PublicRoleRepo::class);
        $this->roleNodeRepo = \App::make(RoleNodeRepo::class);
        $this->nodeProvider = $provider;
    }

    /**
     * @param PublicRoleListRequest $request
     * @return array
     */
    public function getList(PublicRoleListRequest $request)
    {
        $result = $this->repo->getList($request->getEnable(), $request->getPage(), $request->getPerpage());

        return $result->toArray();
    }

    /**
     * 角色總數
     * @param PublicRoleListRequest $request
     * @return int
     */
    public function total(PublicRoleListRequest $request)
    {
        return $this->repo->count($request->getEnable());
    }

    /**
     * @param PublicRoleInfoRequest $request
     * @return Role|null
     */
    public function find(PublicRoleInfoRequest $request)
    {
        $result = $this->repo->find($request->getId());

        return $result;
    }

    /**
     * @param PublicRoleAuthorizationRequest $request
     * @return array
     * @throws ApiErrorCodeException
     */
    public function refreshPublicNodes(PublicRoleAuthorizationRequest $request)
    {
        $role = $this->repo->find($request->getId());
        if (is_null($role)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        // 因為提供設定的節點只有public,設定時要保留un public nodes.
        $want = $this->nodeProvider->getByIds($request->getNodes());
        $keep = $this->roleNodeRepo->loadUnPublicNodes($role);
        $result = $this->roleNodeRepo->bindNodesByIds($role, $want->merge($keep));

        return $result;
    }

    /**
     * @param PublicRoleNodeMapRequest $request
     * @return Collection|NodeGroup[]
     * @throws ApiErrorCodeException
     */
    public function publicNodeMap(PublicRoleNodeMapRequest $request)
    {
        $role = $this->repo->find($request->getId());
        if (is_null($role)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }

        return $this->roleNodeRepo->loadPublicNodes($role);
    }

    /**
     * @return Collection|NodeGroup[]
     */
    public function authorizedNodes()
    {
        return $this->nodeProvider->get();
    }
}
