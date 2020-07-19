<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/2
 * Time: 下午 03:15
 */

namespace Modules\Member\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Modules\Member\Contracts\IFavoriteProvider;
use Modules\Member\Http\Requests\Client\MyFavoriteActionRequestHandle;
use Modules\Member\Services\MyFavoriteActionService;

trait MyFavoriteAction
{
    /**
     * @param MyFavoriteActionRequestHandle $request
     * @param AuthManager $auth
     * @return \Modules\Member\Contracts\ICollectible
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function add(MyFavoriteActionRequestHandle $request, AuthManager $auth)
    {
        return app(MyFavoriteActionService::class, ['auth' => $auth->guard()->user()])
            ->save($request, $this->getFavoriteRepo());
    }

    /**
     * @param MyFavoriteActionRequestHandle $request
     * @param AuthManager $auth
     * @return \Modules\Member\Contracts\ICollectible
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function remove(MyFavoriteActionRequestHandle $request, AuthManager $auth)
    {
        return app(MyFavoriteActionService::class, ['auth' => $auth->guard()->user()])
            ->remove($request, $this->getFavoriteRepo());
    }

    /**
     * @return IFavoriteProvider
     */
    abstract public function getFavoriteRepo(): IFavoriteProvider;
}
