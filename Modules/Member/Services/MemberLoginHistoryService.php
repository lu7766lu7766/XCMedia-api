<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/6
 * Time: 上午 11:23
 */

namespace Modules\Member\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Member\Repositories\MemberLoginHistoryRepo;

class MemberLoginHistoryService
{
    /**
     * @param int $id
     * @param int|null $page
     * @param int|null $perpage
     * @return Collection|\Modules\Member\Entities\MemberLoginHistory[]
     */
    public function personalList(int $id, int $page = null, int $perpage = null)
    {
        return app(MemberLoginHistoryRepo::class)->personalList($id, $page, $perpage);
    }

    /**
     * @param int $id
     * @return int
     */
    public function personalTotal(int $id)
    {
        return app(MemberLoginHistoryRepo::class)->personalTotal($id);
    }

    /**
     * @param int|null $branchId
     * @param string|null $account
     * @param string|null $start
     * @param string|null $end
     * @param int|null $page
     * @param int|null $perpage
     * @return Collection|\Modules\Member\Entities\MemberLoginHistory[]
     */
    public function list(
        int $branchId = null,
        string $account = null,
        string $start = null,
        string $end = null,
        int $page = null,
        int $perpage = null
    ) {
        return app(MemberLoginHistoryRepo::class)->list(
            $branchId,
            $account,
            $start,
            $end,
            $page,
            $perpage
        );
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
        return app(MemberLoginHistoryRepo::class)->total(
            $branchId,
            $account,
            $start,
            $end
        );
    }

    /**
     * @param int $id
     * @return \Modules\Member\Entities\MemberLoginHistory|null
     */
    public function info(int $id)
    {
        return app(MemberLoginHistoryRepo::class)->info($id);
    }
}
