<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/18
 * Time: 下午 03:41
 */

namespace Modules\Member\Services;

use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\ApiCode\OOOO4MemberCode;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Member\Entities\Member;
use Modules\Member\Http\Requests\Client\Profile\UpdatePasswordRequest;
use Modules\Member\Http\Requests\Client\Profile\UpdateRequest;

class ProfileService
{
    /** @var Member $observe */
    private $observe;

    /**
     * ProfileService constructor.
     * @param Member $observe
     */
    public function __construct(Member $observe)
    {
        $this->observe = $observe;
    }

    /**
     * @param UpdateRequest $request
     * @return Member
     * @throws ApiErrorCodeException
     */
    public function update(UpdateRequest $request)
    {
        try {
            $this->observe->update(['phone' => $request->getPhone(), 'mail' => $request->getEmail()]);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'UPDATE MEMBER FAIL');
        }

        return $this->observe;
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return Member
     * @throws ApiErrorCodeException
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        if (!\Hash::check($request->getOldPassword(), $this->observe->getAuthPassword())) {
            throw new ApiErrorCodeException(OOOO4MemberCode::PASSWORD_AUTH_FAILED, 'PASSWORD AUTH FAILED');
        }
        try {
            $this->observe->update(['password' => \Hash::make($request->getNewPassword())]);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw  new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $this->observe;
    }
}
