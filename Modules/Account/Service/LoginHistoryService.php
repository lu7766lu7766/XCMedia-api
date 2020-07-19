<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/7/1
 * Time: 下午 04:43
 */

namespace Modules\Account\Service;

use Modules\Account\Http\Requests\LoginHistoryListRequest;
use Modules\Account\Repository\AccountLoginLogRepo;
use Modules\Role\Contract\IRoleProvider;
use Modules\Role\Entities\Role;

class LoginHistoryService
{
    /** @var IRoleProvider $roleProvider */
    private $roleProvider;
    /**
     * @var AccountLoginLogRepo
     */
    private $accountLoginLogRepo;

    public function __construct(IRoleProvider $provider)
    {
        $this->roleProvider = $provider;
        $this->accountLoginLogRepo = \App::make(AccountLoginLogRepo::class);
    }

    /**
     * @param LoginHistoryListRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Account\Entities\AccountLoginLog[]
     */
    public function getList(LoginHistoryListRequest $request)
    {
        return $this->accountLoginLogRepo->get(
            $request->getStart(),
            $request->getEnd(),
            $request->getRoleId(),
            $request->getKeyword(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param LoginHistoryListRequest $request
     * @return int
     */
    public function total(LoginHistoryListRequest $request)
    {
        return $this->accountLoginLogRepo->count(
            $request->getStart(),
            $request->getEnd(),
            $request->getRoleId(),
            $request->getKeyword()
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Role[]
     */
    public function authorizedRoles()
    {
        return $this->roleProvider->get();
    }
}
