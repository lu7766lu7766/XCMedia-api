<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/18
 * Time: 下午 03:20
 */

namespace Modules\Member\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Member\Entities\Member;
use Modules\Member\Http\Requests\Client\Profile\UpdatePasswordRequest;
use Modules\Member\Http\Requests\Client\Profile\UpdateRequest;
use Modules\Member\Services\ProfileService;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function info()
    {
        return \Auth::guard()->user();
    }

    /**
     * @param UpdateRequest $request
     * @return Member
     * @throws ApiErrorCodeException
     */
    public function update(UpdateRequest $request)
    {
        $service = app(ProfileService::class, ['observe' => \Auth::guard()->user()]);

        return $service->update($request);
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return Member
     * @throws ApiErrorCodeException
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        /** @var ProfileService $service */
        $service = app(ProfileService::class, ['observe' => \Auth::guard()->user()]);

        return $service->updatePassword($request);
    }
}
