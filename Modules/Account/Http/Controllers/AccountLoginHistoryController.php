<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Account\Http\Requests\LoginHistoryListRequest;
use Modules\Account\Service\LoginHistoryService;

class AccountLoginHistoryController extends Controller
{
    /**
     * @param LoginHistoryListRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Account\Entities\AccountLoginLog[]
     */
    public function index(LoginHistoryListRequest $request)
    {
        return \App::make(LoginHistoryService::class)->getList($request);
    }

    /**
     * @param LoginHistoryListRequest $request
     * @return int
     */
    public function total(LoginHistoryListRequest $request)
    {
        return \App::make(LoginHistoryService::class)->total($request);
    }

    /**
     * @return array
     */
    public function options()
    {
        return ['role' => \App::make(LoginHistoryService::class)->authorizedRoles()];
    }
}
