<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 02:43
 */

namespace Modules\Member\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Branch\Entities\Branch;
use Modules\Member\Constants\MemberStatusConstants;
use Modules\Member\Entities\Member;

class MemberRepo
{
    /**
     * @param int|null $branchId
     * @param string|null $status
     * @param string|null $keyword
     * @param int $page
     * @param int $perpage
     * @return Collection|Member[]
     */
    public function list(
        int $branchId = null,
        string $status = null,
        string $keyword = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $builder = Member::whereHas('branch', function (Builder $builder) use ($branchId) {
                if (!is_null($branchId)) {
                    $builder->where('branch.id', $branchId);
                }
            });
            if (!is_null($status)) {
                $builder->where('status', $status);
            }
            if (!is_null($keyword)) {
                $builder->where(function (Builder $builder) use ($keyword) {
                    $builder->where('account', 'LIKE', "%{$keyword}%")
                        ->orWhere('mail', 'LIKE', "%{$keyword}%")
                        ->orWhere('phone', 'LIKE', "%{$keyword}%");
                });
            }
            $result = $builder->orderByDesc('id')
                ->forPage($page, $perpage)
                ->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $branchId
     * @param string|null $status
     * @param string|null $keyword
     * @return int
     */
    public function total(
        int $branchId = null,
        string $status = null,
        string $keyword = null
    ) {
        try {
            $builder = Member::whereHas('branch', function (Builder $builder) use ($branchId) {
                if (!is_null($branchId)) {
                    $builder->where('branch.id', $branchId);
                }
            });
            if (!is_null($status)) {
                $builder->where('status', $status);
            }
            if (!is_null($keyword)) {
                $builder->where(function (Builder $builder) use ($keyword) {
                    $builder->where('account', 'LIKE', "%{$keyword}%")
                        ->orWhere('mail', 'LIKE', "%{$keyword}%")
                        ->orWhere('phone', 'LIKE', "%{$keyword}%");
                });
            }
            $result = $builder->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return Member|null
     */
    public function find(int $id)
    {
        $result = null;
        try {
            $result = Member::find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * 新增會員帳號
     * @param array $attribute
     * @param string $password
     * @param Branch|Model $branch
     * @return Member|null
     */
    public function create(array $attribute, string $password, Branch $branch)
    {
        try {
            $attribute['password'] = \Hash::make($password);
            $result = $branch->member()->create($attribute);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * 編輯會員帳號
     * @param Member $member
     * @param array $attribute
     * @param string|null $password
     * @return Member|null
     */
    public function update(Member $member, array $attribute, string $password = null)
    {
        try {
            if (!is_null($password)) {
                $member->password = \Hash::make($password);
            }
            $done = $member->fill($attribute)->save();
            $result = $done ? $member : null;
        } catch (\Throwable $e) {
            $result = null;
        }

        return $result;
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        try {
            $result = Member::whereKey($id)->delete();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $account
     * @param int $branchId
     * @return Member|null
     */
    public function findWithTrashedByAccount(string $account, int $branchId)
    {
        try {
            $member = Member::withTrashed()
                ->where('account', $account)
                ->whereHas('branch', function (Builder $query) use ($branchId) {
                    $query->whereKey($branchId);
                })->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $member = null;
        }

        return $member;
    }

    /**
     * @param int $id
     * @param string $domain
     * @return Member|null
     */
    public function findEnableByBranchDomain(int $id, string $domain)
    {
        try {
            $member = Member::whereHas('branch', function (Builder $query) use ($domain) {
                $query->where('domain', $domain)->where('status', NYEnumConstants::YES);
            })->where('status', MemberStatusConstants::ENABLE)->find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $member = null;
        }

        return $member;
    }
}
