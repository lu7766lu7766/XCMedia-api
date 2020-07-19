<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/4
 * Time: 下午 12:59
 */

namespace Modules\Account\Service;

use Illuminate\Database\Eloquent\Collection;
use Modules\Account\Entities\Account;
use Modules\Account\Http\Requests\Manage\AccountCreateRequest;
use Modules\Account\Http\Requests\Manage\AccountDeleteRequest;
use Modules\Account\Http\Requests\Manage\AccountIndexRequest;
use Modules\Account\Http\Requests\Manage\AccountUpdateRequest;
use Modules\Account\Repository\AccountRepo;
use Modules\Account\Repository\AccountRoleRepo;
use Modules\Base\Constants\ApiCode\OOOO2AccountCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Role\Contract\IRoleProvider;

/**
 * Provider only public role account modify.
 * Class ManageAccountService
 * @package Modules\Account\Service
 */
class ManageAccountService
{
    /**
     * @var AccountRoleRepo
     */
    private $accountRoleRepo;
    /**
     * @var IRoleProvider
     */
    private $roleProvider;
    /**
     * @var AccountRepo
     */
    private $repo;

    /**
     * ManageAccountService constructor.
     * @param IRoleProvider $provider
     */
    public function __construct(IRoleProvider $provider)
    {
        $this->roleProvider = $provider;
        $this->accountRoleRepo = \App::make(AccountRoleRepo::class);
        $this->repo = \App::make(AccountRepo::class);
    }

    /**
     * show account list by account or role code
     * @param AccountIndexRequest $request
     * @return Account[]|Collection
     */
    public function getList(AccountIndexRequest $request)
    {
        $result = $this->accountRoleRepo->getPublicRoleAccounts(
            $request->getRoleId(),
            $request->getAccount(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        );

        return $result;
    }

    /**
     * show the total number of account list by account or role code
     * @param AccountIndexRequest $request
     * @return array
     */
    public function total(AccountIndexRequest $request)
    {
        $total = $this->accountRoleRepo->countPublicRoleAccount(
            $request->getRoleId(),
            $request->getAccount(),
            $request->getStatus()
        );

        return $total;
    }

    /**
     * Add system account
     * @param AccountCreateRequest $request
     * @return Account
     * @throws \Throwable
     */
    public function create(AccountCreateRequest $request)
    {
        $account = null;
        \DB::transaction(function () use (&$account, $request) {
            $account = $this->repo->create(
                [
                    'account'      => $request->getAccount(),
                    'display_name' => $request->getDisplayName(),
                    'status'       => $request->getStatus(),
                    'remark'       => $request->getRemark()
                ],
                $request->getPassword()
            );
            if (is_null($account)) {
                throw new ApiErrorCodeException(OOOO2AccountCodes::ACCOUNT_CREATE_FAIL);
            }
            $this->attachRoles($account, $request->getRoleIds());
        });

        return $account;
    }

    /**
     * Update account information
     * @param AccountUpdateRequest $request
     * @return null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(AccountUpdateRequest $request)
    {
        $exist = $this->accountRoleRepo->findPublicRoleAccount($request->getId());
        if (is_null($exist)) {
            throw new ApiErrorCodeException(OOOO2AccountCodes::ACCOUNT_NOT_FOUND);
        }
        \DB::transaction(function () use ($exist, $request) {
            $attribute = [
                'display_name' => $request->getDisplayName(),
                'status'       => $request->getStatus(),
                'remark'       => $request->getRemark()
            ];
            $this->repo->update($exist, $attribute, $request->getPassword());
            if (!is_null($request->getRoleIds())) {
                $this->attachRoles($exist, $request->getRoleIds());
            }
        });

        return $exist;
    }

    /**
     * Delete the account by modifying the status value
     * @param AccountDeleteRequest $request
     * @return int
     */
    public function delete(AccountDeleteRequest $request)
    {
        return $this->accountRoleRepo->delPublicRoleAccount($request->getId());
    }

    /**
     * @return Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function authorizedRoles()
    {
        return $this->roleProvider->get();
    }

    /**
     * Attach role.
     * @param Account $account
     * @param array $roleIds
     * @return Account
     */
    protected function attachRoles(Account $account, array $roleIds)
    {
        $roles = $this->roleProvider->getByIds($roleIds);
        $account->roles()->sync($roles);
        $account->setRelation('roles', $roles);

        return $account;
    }
}
