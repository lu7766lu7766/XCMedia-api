<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/15
 * Time: 下午 02:21
 */

namespace Modules\Member\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Branch\Contracts\IBranchProvider;
use Modules\Member\Http\Requests\Client\RegisterRequest;
use Modules\Member\Http\Requests\Client\SendVerificationCodeRequestHandle;
use Modules\Member\Services\MemberService;

class MemberController extends Controller
{
    /** @var MemberService $service */
    private $service;

    /**
     * MemberController constructor.
     * @param MemberService $service
     */
    public function __construct(MemberService $service)
    {
        $this->service = $service;
    }

    /**
     * @param RegisterRequest $request
     * @return \Modules\Member\Entities\Member|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function register(RegisterRequest $request)
    {
        return $this->service->register($request, app(IBranchProvider::class));
    }

    /**
     * @param SendVerificationCodeRequestHandle $request
     * @return array
     * @throws ApiErrorCodeException
     */
    public function sendVerificationCode(SendVerificationCodeRequestHandle $request)
    {
        return $this->service->verificationCode($request, app(IBranchProvider::class));
    }

    /**
     * @return array
     */
    public function logout()
    {
        return ['data' => \Auth::user()->token()->revoke()];
    }
}
