<?php

namespace Modules\Account\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Account\Http\Requests\PilotProfileEditRequest;
use Modules\Account\Service\AccountService;

class PilotController extends Controller
{
    /**
     * A simple method for use.
     * @return array
     */
    public function profile()
    {
        $service = \App::make(AccountService::class);

        return $service->profile()->toArray();
    }

    /**
     * Update login user information
     * @param PilotProfileEditRequest $request
     * @return null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function edit(PilotProfileEditRequest $request)
    {
        $service = \App::make(AccountService::class);

        return $service->edit($request);
    }

    /**
     * 啟用角色擁有的節點
     * @return array
     */
    public function nodes()
    {
        $service = \App::make(AccountService::class);

        return $service->nodeMap()->toArray();
    }
}
