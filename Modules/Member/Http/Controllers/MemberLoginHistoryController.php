<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 03:20
 */

namespace Modules\Member\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Branch\Repositories\BranchRepo;
use Modules\Member\Http\Requests\Manage\MemberLoginHistoryInfoRequest;
use Modules\Member\Http\Requests\Manage\MemberLoginHistoryListRequest;
use Modules\Member\Http\Requests\Manage\MemberLoginHistoryRequest;
use Modules\Member\Services\MemberLoginHistoryService;

class MemberLoginHistoryController extends Controller
{
    /**
     * @param MemberLoginHistoryRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Member\Entities\MemberLoginHistory[]
     */
    public function personalList(MemberLoginHistoryRequest $request)
    {
        return app(MemberLoginHistoryService::class)->personalList(
            $request->getId(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param \Modules\Member\Http\Requests\Manage\MemberLoginHistoryRequest $request
     * @return int
     */
    public function personalTotal(MemberLoginHistoryRequest $request)
    {
        return app(MemberLoginHistoryService::class)->personalTotal($request->getId());
    }

    /**
     * @param MemberLoginHistoryListRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Member\Entities\MemberLoginHistory[]
     */
    public function list(MemberLoginHistoryListRequest $request)
    {
        return app(MemberLoginHistoryService::class)->list(
            $request->getBranchId(),
            $request->getAccount(),
            $request->getStart(),
            $request->getEnd(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param MemberLoginHistoryListRequest $request
     * @return int
     */
    public function total(MemberLoginHistoryListRequest $request)
    {
        return app(MemberLoginHistoryService::class)->total(
            $request->getBranchId(),
            $request->getAccount(),
            $request->getStart(),
            $request->getEnd()
        );
    }

    /**
     * @param MemberLoginHistoryInfoRequest $request
     * @return \Modules\Member\Entities\MemberLoginHistory|null
     */
    public function info(MemberLoginHistoryInfoRequest $request)
    {
        return app(MemberLoginHistoryService::class)->info($request->getId());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Branch\Entities\Branch[]
     */
    public function branchList()
    {
        return app(BranchRepo::class)->all();
    }
}
