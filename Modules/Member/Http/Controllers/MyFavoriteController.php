<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/5
 * Time: 下午 07:46
 */

namespace Modules\Member\Http\Controllers;

use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Controller;
use Modules\Member\Http\Requests\Client\IsMyFavoriteRequestHandle;
use Modules\Member\Http\Requests\Client\MyFavoriteActionRequestHandle;
use Modules\Member\Http\Requests\Client\MyFavoriteDeleteRequestHandle;
use Modules\Member\Http\Requests\Client\MyFavoriteListRequestHandle;
use Modules\Member\Http\Requests\Client\MyFavoriteRemoveAllRequestHandle;
use Modules\Member\Services\MyFavoriteService;

class MyFavoriteController extends Controller
{
    /**
     * @param MyFavoriteListRequestHandle $request
     * @param AuthManager $auth
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Member\Entities\MyFavorite[]
     */
    public function index(MyFavoriteListRequestHandle $request, AuthManager $auth)
    {
        return app(MyFavoriteService::class, ['auth' => $auth->guard()->user()])->list($request);
    }

    /**
     * @param MyFavoriteListRequestHandle $request
     * @param AuthManager $auth
     * @return int
     */
    public function total(MyFavoriteListRequestHandle $request, AuthManager $auth)
    {
        return app(MyFavoriteService::class, ['auth' => $auth->guard()->user()])->total($request);
    }

    /**
     * @param MyFavoriteActionRequestHandle $request
     * @param AuthManager $auth
     * @return int
     */
    public function remove(MyFavoriteDeleteRequestHandle $request, AuthManager $auth)
    {
        return app(MyFavoriteService::class, ['auth' => $auth->guard()->user()])->remove($request);
    }

    /**
     * @param AuthManager $auth
     * @param MyFavoriteRemoveAllRequestHandle $request
     * @return int
     */
    public function removeAll(AuthManager $auth, MyFavoriteRemoveAllRequestHandle $request)
    {
        return app(MyFavoriteService::class, ['auth' => $auth->guard()->user()])->removeAll($request);
    }

    /**
     * @param AuthManager $auth
     * @param IsMyFavoriteRequestHandle $request
     * @return \Modules\Member\Entities\Member|null
     */
    public function isMyFavorite(AuthManager $auth, IsMyFavoriteRequestHandle $request)
    {
        return app(MyFavoriteService::class, ['auth' => $auth->guard()->user()])->isMyFavorite($request->getMediaId());
    }
}
