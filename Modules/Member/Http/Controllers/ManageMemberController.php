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
use Modules\Member\Constants\MemberStatusConstants;
use Modules\Member\Http\Requests\Manage\MemberCreateRequest;
use Modules\Member\Http\Requests\Manage\MemberListRequest;
use Modules\Member\Http\Requests\Manage\MemberProfileRequest;
use Modules\Member\Http\Requests\Manage\MemberUpdateRequest;
use Modules\Member\Services\ManageMemberService;

class ManageMemberController extends Controller
{
    /**
     * @param MemberListRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Member\Entities\Member[]
     */
    public function list(MemberListRequest $request)
    {
        return app(ManageMemberService::class)->list($request);
    }

    /**
     * @param MemberListRequest $request
     * @return int
     */
    public function total(MemberListRequest $request)
    {
        return app(ManageMemberService::class)->total($request);
    }

    /**
     * @param \Modules\Member\Http\Requests\Manage\MemberProfileRequest $request
     * @return \Modules\Member\Entities\Member|null
     */
    public function profile(MemberProfileRequest $request)
    {
        return app(ManageMemberService::class)->profile($request);
    }

    /**
     * @param MemberCreateRequest $request
     * @return \Modules\Member\Entities\Member|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function create(MemberCreateRequest $request)
    {
        return app(ManageMemberService::class)->create($request);
    }

    /**
     * @param MemberUpdateRequest $request
     * @return \Modules\Member\Entities\Member|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(MemberUpdateRequest $request)
    {
        return app(ManageMemberService::class)->update($request);
    }

    /**
     * @param \Modules\Member\Http\Requests\Manage\MemberProfileRequest $request
     * @return int
     */
    public function delete(MemberProfileRequest $request)
    {
        return app(ManageMemberService::class)->delete($request);
    }

    /**
     * @return array
     */
    public function statusList()
    {
        return MemberStatusConstants::common();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Branch\Entities\Branch[]
     */
    public function branchList()
    {
        return app(BranchRepo::class)->all();
    }
}
