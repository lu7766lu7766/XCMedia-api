<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/10
 * Time: 下午 04:44
 */

namespace Modules\Member\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Modules\Classified\Contracts\IClassifiedRepo;
use Modules\Member\Http\Requests\Client\Comment\MemberCommentAddRequestHandle;
use Modules\Member\Services\MemberCommentService;

trait MemberComment
{
    /**
     * @param MemberCommentAddRequestHandle $request
     * @param AuthManager $auth
     * @return array
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function add(MemberCommentAddRequestHandle $request, AuthManager $auth)
    {
        $service = new MemberCommentService($auth->guard()->user(), $this->getClassifiedRepo());

        return ['result' => $service->add($request)];
    }

    /**
     * @return IClassifiedRepo
     */
    abstract public function getClassifiedRepo(): IClassifiedRepo;
}
