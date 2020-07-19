<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/6
 * Time: 下午 01:59
 */

namespace Modules\Account\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Account\Entities\Account;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;

class AccountRoleRepo
{
    /**
     * Get account by account id and account roles exclude $exclude.
     * @param int $id account id.
     * @return Account|null
     */
    public function findPublicRoleAccount(int $id)
    {
        $result = null;
        try {
            $result = Account::where('account.id', $id)
                ->whereDoesntHave('roles', function (Builder $builder) {
                    $builder->where('role.enable', NYEnumConstants::NO);
                })->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $roleId
     * @param string|null $account
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Account[]|Collection
     */
    public function getPublicRoleAccounts(
        int $roleId = null,
        string $account = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        $result = collect();
        try {
            $builder = Account::with('roles');
            if (!is_null($roleId)) {
                $builder->whereHas('roles', function (Builder $builder) use ($roleId) {
                    $builder->where('role.id', $roleId);
                });
            }
            if (!is_null($account)) {
                $builder->where('account', 'LIKE', "%{$account}%");
            }
            if (!is_null($status)) {
                $builder->where('status', $status);
            }
            $result = $builder->whereDoesntHave('roles', function (Builder $builder) use ($roleId) {
                $builder->where('public', NYEnumConstants::NO);
            })
                ->orderByDesc('id')
                ->forPage($page, $perpage)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $roleId
     * @param string|null $account
     * @param null|string $status
     * @return Account[]|Collection
     */
    public function countPublicRoleAccount(?int $roleId, ?string $account, ?string $status)
    {
        $result = collect();
        try {
            $builder = Account::query();
            if (!is_null($roleId)) {
                $builder->whereHas('roles', function (Builder $builder) use ($roleId) {
                    $builder->where('role.id', $roleId);
                });
            }
            if (!is_null($account)) {
                $builder->where('account', 'LIKE', "%{$account}%");
            }
            if (!is_null($status)) {
                $builder->where('status', $status);
            }
            $result = $builder->whereDoesntHave('roles', function (Builder $builder) use ($roleId) {
                $builder->where('public', NYEnumConstants::NO);
            })->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return int
     */
    public function delPublicRoleAccount(int $id)
    {
        $result = 0;
        try {
            $result = Account::whereKey($id)
                ->whereDoesntHave('roles', function (Builder $builder) {
                    $builder->where('public', NYEnumConstants::NO);
                })->delete();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
