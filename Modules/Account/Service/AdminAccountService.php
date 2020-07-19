<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/6/26
 * Time: 下午 03:11
 */

namespace Modules\Account\Service;

use Modules\Account\Entities\Account;
use Modules\Account\Repository\AccountRepo;
use Modules\Role\Constants\RoleInherentConstants;
use Modules\Role\Contract\IRoleProvider;

class AdminAccountService
{
    /**
     * @var IRoleProvider
     */
    private $roleProvider;
    /**
     * @var AccountRepo
     */
    private $repo;

    /**
     * Initialize class.
     * @param IRoleProvider $provider
     */
    public function __construct(IRoleProvider $provider)
    {
        $this->roleProvider = $provider;
        $this->repo = \App::make(AccountRepo::class);
    }

    /**
     * @throws \Throwable
     */
    public function createAdmin()
    {
        $password = \Config::get('Account.config.admin.password');
        $param = \Config::get('Account.config.admin.profile');
        $this->create($param, $password, RoleInherentConstants::ADMIN);
    }

    /**
     * @param array $param
     * @param string $password
     * @param string $roleCode
     * @return Account|null
     * @throws \Throwable
     */
    public function create(array $param, string $password, string $roleCode)
    {
        $role = $this->roleProvider->firstByCode($roleCode);
        $account = null;
        \DB::transaction(function () use (&$account, $param, $password, $role) {
            $account = $this->repo->create($param, $password);
            if (!is_null($account)) {
                $account->roles()->sync($role);
            }
        });

        return $account;
    }
}
