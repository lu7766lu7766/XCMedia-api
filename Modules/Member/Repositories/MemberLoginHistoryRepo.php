<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/6
 * Time: 上午 11:47
 */

namespace Modules\Member\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Member\Entities\MemberLoginHistory;

class MemberLoginHistoryRepo
{
    /**
     * @param int $id
     * @param int $page
     * @param int $perpage
     * @return Collection|MemberLoginHistory[]
     */
    public function personalList(int $id, int $page = 1, int $perpage = 20)
    {
        try {
            $result = MemberLoginHistory::whereHas('owner')
                ->whereHas('owner.branch')
                ->where('member_id', $id)
                ->orderByDesc('id')
                ->forPage($page, $perpage)
                ->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return int
     */
    public function personalTotal(int $id)
    {
        try {
            $result = MemberLoginHistory::whereHas('owner')
                ->whereHas('owner.branch')
                ->where('member_id', $id)->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $branchId
     * @param string|null $account
     * @param string|null $start
     * @param string|null $end
     * @param int $page
     * @param int $perpage
     * @return MemberLoginHistory[]|Collection
     */
    public function list(
        int $branchId = null,
        string $account = null,
        string $start = null,
        string $end = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $builder = MemberLoginHistory::with(['owner', 'owner.branch'])
                ->whereHas('owner.branch', function (Builder $builder) use ($branchId) {
                    if (!is_null($branchId)) {
                        $builder->where('branch.id', $branchId);
                    }
                })
                ->whereHas('owner', function (Builder $builder) use ($account) {
                    if (!is_null($account)) {
                        $builder->where('member.account', 'LIKE', "%{$account}%");
                    }
                });
            if (!is_null($start) && !is_null($end)) {
                $builder->whereBetween('created_at', [$start, $end]);
            }
            $result = $builder->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $branchId
     * @param string|null $account
     * @param string|null $start
     * @param string|null $end
     * @return int
     */
    public function total(
        int $branchId = null,
        string $account = null,
        string $start = null,
        string $end = null
    ) {
        try {
            $builder = MemberLoginHistory::whereHas('owner.branch', function (Builder $builder) use ($branchId) {
                if (!is_null($branchId)) {
                    $builder->where('branch.id', $branchId);
                }
            })
                ->whereHas('owner', function (Builder $builder) use ($account) {
                    if (!is_null($account)) {
                        $builder->where('member.account', 'LIKE', "%{$account}%");
                    }
                });
            if (!is_null($start) && !is_null($end)) {
                $builder->whereBetween('created_at', [$start, $end]);
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
     * @return MemberLoginHistory|null
     */
    public function info(int $id)
    {
        try {
            $result = MemberLoginHistory::with(['owner', 'owner.branch'])
                ->whereHas('owner.branch')
                ->whereHas('owner')
                ->whereKey($id)
                ->first();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
