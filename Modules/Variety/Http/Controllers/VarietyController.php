<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/5
 * Time: 下午 05:22
 */

namespace Modules\Variety\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Episode\Constants\EpisodeStatusConstants;
use Modules\Variety\Http\Requests\Client\CommentsListRequestHandle;
use Modules\Variety\Http\Requests\Client\GetIdRequestHandle;
use Modules\Variety\Http\Requests\Client\ListRequestHandle;
use Modules\Member\Contracts\IFavoriteProvider;
use Modules\Member\Http\Controllers\MyFavoriteAction;
use Modules\Variety\Repositories\VarietyRepo;
use Modules\Variety\Services\VarietyService;
use XC\Independent\Kit\Utils\UrlParserUtil;

class VarietyController extends Controller
{
    use MyFavoriteAction;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Variety\Entities\Variety[]
     */
    public function index()
    {
        $service = new VarietyService();

        return $service->getLatest();
    }

    /**
     * @return IFavoriteProvider
     */
    public function getFavoriteRepo(): IFavoriteProvider
    {
        return new VarietyRepo();
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Variety\Entities\Variety[]
     */
    public function latestList(ListRequestHandle $request)
    {
        return app(VarietyService::class)->latestList($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Variety\Entities\Variety[]
     */
    public function popularList(ListRequestHandle $request)
    {
        return app(VarietyService::class)->popularList($request);
    }

    /**
     * @param ListRequestHandle $request
     * @param UrlParserUtil $url
     * @return Collection|\Modules\Variety\Entities\Variety[]
     */
    public function mostCommentList(ListRequestHandle $request, UrlParserUtil $url)
    {
        return app(VarietyService::class)->mostCommentList($request, $url);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return app(VarietyService::class)->total($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Modules\Variety\Entities\Variety|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function info(GetIdRequestHandle $request)
    {
        return app(VarietyService::class)->info($request);
    }

    /**
     * @param CommentsListRequestHandle $request
     * @param UrlParserUtil $url
     * @return Model|\Modules\Variety\Entities\Variety|null
     */
    public function commentsList(CommentsListRequestHandle $request, UrlParserUtil $url)
    {
        return app(VarietyService::class)->commentsList($request, $url);
    }

    /**
     * @param CommentsListRequestHandle $request
     * @param UrlParserUtil $url
     * @return int
     */
    public function commentsTotal(CommentsListRequestHandle $request, UrlParserUtil $url)
    {
        return app(VarietyService::class)->commentsTotal($request, $url);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Collection|\Modules\Classified\Entities\Source[]
     */
    public function source(GetIdRequestHandle $request)
    {
        return app(VarietyService::class)->source($request->getId());
    }

    /**
     * @return array
     */
    public function options()
    {
        return [
            'genres'         => app(GenresSettingRepo::class)->getEnableUsedType(ClassifiedConstant::VARIETY),
            'region'         => app(RegionRepo::class)->getEnableByUsedType(ClassifiedConstant::VARIETY),
            'years'          => app(YearsSettingRepo::class)->getEnableByType(ClassifiedConstant::VARIETY),
            'language'       => app(LanguageSettingRepo::class)->getAllByUsedType(ClassifiedConstant::VARIETY),
            'episode_status' => EpisodeStatusConstants::enum()
        ];
    }

    /**
     * @param GetIdRequestHandle $request
     * @return array
     */
    public function isFavorite(GetIdRequestHandle $request)
    {
        return ['data' => app(VarietyService::class)->isFavorite($request, \Auth::guard()->user())];
    }
}
