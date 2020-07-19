<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/6
 * Time: 上午 11:42
 */

namespace Modules\Member\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Member\Contracts\ICollectible;
use Modules\Member\Contracts\IFavoriteProvider;
use Modules\Member\Http\Requests\Client\MyFavoriteActionRequestHandle;

class MyFavoriteActionService
{
    /** @var Authenticatable $observer */
    private $observer;

    /**
     * MyFavoriteActionService constructor.
     * @param Authenticatable $auth
     */
    public function __construct(Authenticatable $auth)
    {
        $this->observer = $auth;
    }

    /**
     * @param MyFavoriteActionRequestHandle $request
     * @param IFavoriteProvider $provider
     * @return \Modules\Member\Contracts\ICollectible
     * @throws ApiErrorCodeException
     */
    public function save(MyFavoriteActionRequestHandle $request, IFavoriteProvider $provider)
    {
        /** @var ICollectible $media */
        $media = $provider->findEnable($request->getMediaId());
        if (is_null($media)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $media->myFavorite()->syncWithoutDetaching($this->observer->getAuthIdentifier());

        return $media;
    }

    /**
     * @param MyFavoriteActionRequestHandle $request
     * @param IFavoriteProvider $provider
     * @return \Modules\Member\Contracts\ICollectible
     * @throws ApiErrorCodeException
     */
    public function remove(MyFavoriteActionRequestHandle $request, IFavoriteProvider $provider)
    {
        /** @var ICollectible $media */
        $media = $provider->findEnable($request->getMediaId());
        if (is_null($media)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $media->myFavorite()->detach($this->observer->getAuthIdentifier());

        return $media;
    }
}
