<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/6
 * Time: 下午 08:30
 */

namespace Modules\Variety\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\SourceSettingRepo;
use Modules\Variety\Http\Requests\Client\CommentsListRequestHandle;
use Modules\Variety\Http\Requests\Client\GetIdRequestHandle;
use Modules\Variety\Http\Requests\Client\ListRequestHandle;
use Modules\Variety\Repositories\VarietyRepo;
use XC\Independent\Kit\Utils\UrlParserUtil;

class VarietyService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Variety\Entities\Variety[]
     */
    public function getLatest()
    {
        $repo = new VarietyRepo();

        return $repo->limitTen();
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Variety\Entities\Variety[]
     */
    public function latestList(ListRequestHandle $request)
    {
        return app(VarietyRepo::class)->latestList(
            $request->getGenresId(),
            $request->getRegionId(),
            $request->getYearsId(),
            $request->getLanguageId(),
            $request->getEpisodeStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Variety\Entities\Variety[]
     */
    public function popularList(ListRequestHandle $request)
    {
        return app(VarietyRepo::class)->popularList(
            $request->getGenresId(),
            $request->getRegionId(),
            $request->getYearsId(),
            $request->getLanguageId(),
            $request->getEpisodeStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param ListRequestHandle $request
     * @param UrlParserUtil $url
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Variety\Entities\Variety[]
     */
    public function mostCommentList(ListRequestHandle $request, UrlParserUtil $url)
    {
        return app(VarietyRepo::class)->mostCommentList(
            $url->host(),
            $request->getGenresId(),
            $request->getRegionId(),
            $request->getYearsId(),
            $request->getLanguageId(),
            $request->getEpisodeStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return app(VarietyRepo::class)->total(
            $request->getGenresId(),
            $request->getRegionId(),
            $request->getYearsId(),
            $request->getLanguageId(),
            $request->getEpisodeStatus()
        );
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Modules\Variety\Entities\Variety|null
     * @throws ApiErrorCodeException
     */
    public function info(GetIdRequestHandle $request)
    {
        $result = app(VarietyRepo::class)->info($request->getId());
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        $result->increment('views');

        return $result;
    }

    /**
     * @param CommentsListRequestHandle $request
     * @param UrlParserUtil $url
     * @return \Illuminate\Database\Eloquent\Model|\Modules\Variety\Entities\Variety|null
     */
    public function commentsList(CommentsListRequestHandle $request, UrlParserUtil $url)
    {
        return app(VarietyRepo::class)->getComments(
            $request->getVarietyId(),
            $url->host(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param CommentsListRequestHandle $request
     * @param UrlParserUtil $url
     * @return int
     */
    public function commentsTotal(CommentsListRequestHandle $request, UrlParserUtil $url)
    {
        return app(VarietyRepo::class)->countComments(
            $request->getVarietyId(),
            $url->host()
        );
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Source[]
     */
    public function source(int $id)
    {
        $repo = new SourceSettingRepo(ClassifiedConstant::VARIETY);

        return $repo->getAllByUsedTypeWithEpisode($id);
    }

    /**
     * @param GetIdRequestHandle $request
     * @param Authenticatable $auth
     * @return bool
     */
    public function isFavorite(GetIdRequestHandle $request, Authenticatable $auth)
    {
        return app(VarietyRepo::class)->isFavoriteByMember(
            $request->getId(),
            $auth->getAuthIdentifier()
        );
    }
}
