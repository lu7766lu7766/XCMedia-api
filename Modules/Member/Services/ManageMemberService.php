<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 05:45
 */

namespace Modules\Member\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Branch\Contracts\IBranchProvider;
use Modules\Member\Entities\Member;
use Modules\Member\Http\Requests\Manage\MemberCreateRequest;
use Modules\Member\Http\Requests\Manage\MemberListRequest;
use Modules\Member\Http\Requests\Manage\MemberProfileRequest;
use Modules\Member\Http\Requests\Manage\MemberUpdateRequest;
use Modules\Member\Repositories\MemberRepo;

class ManageMemberService
{
    /** @var IBranchProvider $branchProvider */
    private $branchProvider;

    /**
     * ManageMemberService constructor.
     * @param IBranchProvider $branchProvider
     */
    public function __construct(IBranchProvider $branchProvider)
    {
        $this->branchProvider = $branchProvider;
    }

    /**
     * @param MemberListRequest $request
     * @return Collection|Member[]
     */
    public function list(MemberListRequest $request)
    {
        return app(MemberRepo::class)->list(
            $request->getBranchId(),
            $request->getStatus(),
            $request->getKeyword(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param MemberListRequest $request
     * @return int
     */
    public function total(MemberListRequest $request)
    {
        return app(MemberRepo::class)->total(
            $request->getBranchId(),
            $request->getStatus(),
            $request->getKeyword()
        );
    }

    /**
     * @param \Modules\Member\Http\Requests\Manage\MemberProfileRequest $request
     * @return Member|null
     */
    public function profile(MemberProfileRequest $request)
    {
        return app(MemberRepo::class)->find($request->getId());
    }

    /**
     * @param MemberCreateRequest $request
     * @return Member|null
     * @throws ApiErrorCodeException
     */
    public function create(MemberCreateRequest $request)
    {
        $branch = $this->branchProvider->find($request->getBranchId());
        if (is_null($branch)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attribute = [
            'account'       => $request->getAccount(),
            'display_name'  => $request->getDisplayName(),
            'phone'         => $request->getPhone(),
            'phone_approve' => $request->getPhoneApprove(),
            'mail'          => $request->getMail(),
            'mail_approve'  => $request->getMailApprove(),
            'status'        => $request->getStatus(),
            'remark'        => $request->getRemark()
        ];
        $member = app(MemberRepo::class)->create($attribute, $request->getPassword(), $branch);
        if (is_null($member)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL);
        }

        return $member;
    }

    /**
     * @param MemberUpdateRequest $request
     * @return Member|null
     * @throws ApiErrorCodeException
     */
    public function update(MemberUpdateRequest $request)
    {
        $member = app(MemberRepo::class)->find($request->getId());
        if (is_null($member)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        $attribute = [
            'display_name'  => $request->getDisplayName(),
            'phone'         => $request->getPhone(),
            'phone_approve' => $request->getPhoneApprove(),
            'mail'          => $request->getMail(),
            'mail_approve'  => $request->getMailApprove(),
            'status'        => $request->getStatus(),
            'remark'        => $request->getRemark()
        ];
        $result = app(MemberRepo::class)->update($member, $attribute, $request->getPassword());
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $result;
    }

    /**
     * @param MemberProfileRequest $request
     * @return int
     */
    public function delete(MemberProfileRequest $request)
    {
        return app(MemberRepo::class)->delete($request->getId());
    }
}
