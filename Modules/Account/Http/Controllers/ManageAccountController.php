<?php

namespace Modules\Account\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Account\Constants\AccountStatusConstants;
use Modules\Account\Http\Requests\Manage\AccountCreateRequest;
use Modules\Account\Http\Requests\Manage\AccountDeleteRequest;
use Modules\Account\Http\Requests\Manage\AccountIndexRequest;
use Modules\Account\Http\Requests\Manage\AccountUpdateRequest;
use Modules\Account\Service\ManageAccountService;

/**
 * Handle CRUD account with only public role condition.
 * Class ManageAccountController
 * @package Modules\Account\Http\Controllers
 */
class ManageAccountController extends Controller
{
    /**
     * Only public role account list.
     * @param AccountIndexRequest $request
     * @return array
     */
    public function index(AccountIndexRequest $request)
    {
        $service = \App::make(ManageAccountService::class);

        return $service->getList($request)->toArray();
    }

    /**
     * Only public role account total
     * @param AccountIndexRequest $request
     * @return array
     */
    public function total(AccountIndexRequest $request)
    {
        $service = \App::make(ManageAccountService::class);

        return $service->total($request);
    }

    /**
     * @return array
     */
    public function options()
    {
        $service = \App::make(ManageAccountService::class);

        return [
            'roles'  => $service->authorizedRoles()->toArray(),
            'status' => AccountStatusConstants::common()
        ];
    }

    /**
     * Create the only public role account
     * @param AccountCreateRequest $request
     * @return mixed
     * @throws \Throwable
     */
    public function create(AccountCreateRequest $request)
    {
        $service = \App::make(ManageAccountService::class);
        $result = $service->create($request);

        return $result->toArray();
    }

    /**
     * Update the only public role account
     * @param AccountUpdateRequest $request
     * @return mixed
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(AccountUpdateRequest $request)
    {
        $service = \App::make(ManageAccountService::class);

        return $service->update($request);
    }

    /**
     * Delete the only public role account
     * @param $id
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function delete($id)
    {
        $service = \App::make(ManageAccountService::class);
        $request = AccountDeleteRequest::getHandle(compact('id'));
        $count = $service->delete($request);

        return $count;
    }
}
