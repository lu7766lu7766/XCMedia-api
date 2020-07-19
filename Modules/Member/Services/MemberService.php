<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/15
 * Time: 下午 02:29
 */

namespace Modules\Member\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\ApiCode\OOOO4MemberCode;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Branch\Contracts\IBranchProvider;
use Modules\Branch\Entities\Branch;
use Modules\Member\Constants\MemberStatusConstants;
use Modules\Member\Entities\Member;
use Modules\Member\Entities\PhoneApprove;
use Modules\Member\Http\Requests\Client\RegisterRequest;
use Modules\Member\Http\Requests\Client\SendVerificationCodeRequestHandle;
use Modules\Member\Repositories\MemberPhoneApproveRepo;
use Modules\Member\Repositories\MemberRepo;
use Xc\FegineSMS\Constants\ResponseCodeConstants;
use Xc\FegineSMS\FegineSMSClient;

class MemberService
{
    /** @var MemberRepo $repo */
    private $repo;

    /**
     * MemberService constructor.
     * @param MemberRepo $repo
     */
    public function __construct(MemberRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param RegisterRequest $request
     * @param IBranchProvider $branchRepo
     * @return Member|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function register(RegisterRequest $request, IBranchProvider $branchRepo)
    {
        $result = null;
        $branch = $this->checkBranch($request->getDomain(), $branchRepo);
        $this->checkMember($request->getAccount(), $branch->getKey());
        if (!is_null($request->getVerificationCode())) {
            $approve = app(MemberPhoneApproveRepo::class)->find(
                $request->getAccount(),
                $request->getVerificationCode()
            );
            if (is_null($approve)) {
                throw new ApiErrorCodeException(OOOO1CommonCodes::VERIFICATION_CODE_ERROR);
            }
            \DB::transaction(function () use ($approve, $request, $branch, &$result) {
                $attribute = [
                    'account'       => $request->getAccount(),
                    'status'        => MemberStatusConstants::ENABLE,
                    'phone_approve' => NYEnumConstants::YES,
                ];
                $result = $this->repo->create($attribute, $request->getMemberPassword(), $branch);
                if (is_null($result)) {
                    throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL);
                }
                $approve->status = NYEnumConstants::YES;
                $approve->save();
            });
        }

        return $result;
    }

    /**
     * @param SendVerificationCodeRequestHandle $request
     * @param IBranchProvider $branchRepo
     * @return array
     * @throws ApiErrorCodeException
     */
    public function verificationCode(SendVerificationCodeRequestHandle $request, IBranchProvider $branchRepo)
    {
        $branch = $this->checkBranch($request->getDomain(), $branchRepo);
        $this->checkMember($request->getAccount(), $branch->getKey());
        $sms = new FegineSMSClient(config('Member.config.fegine_code'));
        $verificationCode = rand(100001, 999999);
        $response = $sms->send($request->getAccount(), 1, $verificationCode);
        if ($response->getCode() != ResponseCodeConstants::OK) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR);
        }
        $orm = new PhoneApprove();
        $approve = $orm->firstOrNew(['account' => $request->getAccount()]);
        $approve->account = $request->getAccount();
        $approve->code = $verificationCode;
        $approve->status = NYEnumConstants::NO;
        $approve->save();

        return $response->all();
    }

    /**
     * @param string $domain
     * @param IBranchProvider $branchRepo
     * @return Branch|Model|null
     * @throws ApiErrorCodeException
     */
    private function checkBranch(string $domain, IBranchProvider $branchRepo)
    {
        $branch = $branchRepo->findByDomain($domain);
        if (is_null($branch)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'BRANCH NOT FOUND');
        }

        return $branch;
    }

    /**
     * @param string $account
     * @param int $branchId
     * @return Member|null
     * @throws ApiErrorCodeException
     */
    private function checkMember(string $account, int $branchId)
    {
        $member = $this->repo->findWithTrashedByAccount($account, $branchId);
        if (!is_null($member)) {
            throw new ApiErrorCodeException(OOOO4MemberCode::ACCOUNT_IS_EXISTS, 'ACCOUNT IS EXISTS');
        }

        return $member;
    }
}
