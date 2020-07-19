<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/7/1
 * Time: 下午 06:10
 */

namespace Modules\Account\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Account\Entities\AccountLoginLog;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;

class AccountLoginLogRepo
{
    /**
     * @param string $start
     * @param string $end
     * @param int|null $roleId
     * @param string|null $keyword
     * @param int $page
     * @param int $perpage
     * @return AccountLoginLog[]|Collection
     */
    public function get(string $start, string $end, ?int $roleId, ?string $keyword, int $page = 1, int $perpage = 20)
    {
        $result = collect();
        try {
            $query = AccountLoginLog::query()->with(['account', 'account.roles']);
            $query->whereHas('account.roles', function (Builder $builder) use ($roleId) {
                $builder->where('role.public', NYEnumConstants::YES);
                if (!is_null($roleId)) {
                    $builder->where('role.id', $roleId);
                }
            });
            if (!is_null($keyword)) {
                $query->whereHas('account', function (Builder $builder) use ($keyword) {
                    $builder->where('account', $keyword);
                });
            }
            $result = $query->whereBetween('created_at', [$start, $end])
                ->orderBy('created_at', 'DESC')
                ->forPage($page, $perpage)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $start
     * @param string $end
     * @param int|null $roleId
     * @param string|null $keyword
     * @return int
     */
    public function count(string $start, string $end, ?int $roleId, ?string $keyword)
    {
        $result = 0;
        try {
            $query = AccountLoginLog::query();
            $query->whereHas('account.roles', function (Builder $builder) use ($roleId) {
                $builder->where('role.public', NYEnumConstants::YES);
                if (!is_null($roleId)) {
                    $builder->where('role.id', $roleId);
                }
            });
            if (!is_null($keyword)) {
                $query->whereHas('account', function (Builder $builder) use ($keyword) {
                    $builder->where('account', $keyword);
                });
            }
            $result = $query->whereBetween('created_at', [$start, $end])->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
