<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/2
 * Time: 下午 04:32
 */

namespace Modules\Member\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Modules\Base\Constants\ApiCode\OOOO4MemberCode;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Member\Http\Requests\Client\MyFavoriteDeleteRequestHandle;
use Modules\Member\Http\Requests\Client\MyFavoriteListRequestHandle;
use Modules\Member\Http\Requests\Client\MyFavoriteRemoveAllRequestHandle;
use Modules\Member\Repositories\MemberRepo;
use Modules\Member\Repositories\MyFavoriteRepo;
use XC\Independent\Kit\Utils\UrlParserUtil;

class MyFavoriteService
{
    /** @var \Modules\Member\Entities\Member|null $member */
    private $member;
    /** @var MyFavoriteRepo $repo */
    private $repo;

    /**
     * MyCollectionService constructor.
     * @param UrlParserUtil $urlParser
     * @param Authenticatable $auth
     * @throws ApiErrorCodeException
     */
    public function __construct(UrlParserUtil $urlParser, Authenticatable $auth)
    {
        $memberRepo = new MemberRepo();
        $this->member = $memberRepo->findEnableByBranchDomain(
            $auth->getAuthIdentifier(),
            $urlParser->host()
        );
        if (is_null($this->member)) {
            throw new ApiErrorCodeException(OOOO4MemberCode::MEMBER_NOT_FOUND, 'member not found');
        }
        $this->repo = new MyFavoriteRepo();
    }

    /**
     * @param MyFavoriteListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Member\Entities\MyFavorite[]
     */
    public function list(MyFavoriteListRequestHandle $request)
    {
        return $this->repo->list(
            $this->member,
            $request->getMediaType(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param MyFavoriteListRequestHandle $request
     * @return int
     */
    public function total(MyFavoriteListRequestHandle $request)
    {
        return $this->repo->total($this->member, $request->getMediaType());
    }

    /**
     * @param MyFavoriteDeleteRequestHandle $request
     * @return int
     */
    public function remove(MyFavoriteDeleteRequestHandle $request)
    {
        return $this->repo->delete($this->member, $request->getId());
    }

    /**
     * @param MyFavoriteRemoveAllRequestHandle $request
     * @return int
     */
    public function removeAll(MyFavoriteRemoveAllRequestHandle $request)
    {
        return $this->repo->deleteAll($this->member, $request->getMediaType());
    }

    /**
     * @param int $mediaId
     * @return \Modules\Member\Entities\Member|null
     */
    public function isMyFavorite(int $mediaId)
    {
        return $this->repo->isMyFavorite($this->member, ClassifiedConstant::DRAMA, $mediaId);
    }
}
