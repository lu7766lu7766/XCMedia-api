<?php

namespace Modules\Movie\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Movie\Http\Requests\Client\MovieCommentsListRequest;
use Modules\Movie\Http\Requests\Client\MovieIndexRequest;
use Modules\Movie\Http\Requests\Client\MovieInfoRequest;
use Modules\Member\Contracts\IFavoriteProvider;
use Modules\Member\Http\Controllers\MyFavoriteAction;
use Modules\Movie\Repositories\MovieRepo;
use Modules\Movie\Services\MovieService;
use XC\Independent\Kit\Utils\UrlParserUtil;

class MovieController extends Controller
{
    use MyFavoriteAction;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Movie\Entities\Movie[]
     */
    public function index()
    {
        $service = new MovieService();

        return $service->getLatest();
    }

    /**
     * @return IFavoriteProvider
     */
    public function getFavoriteRepo(): IFavoriteProvider
    {
        return new MovieRepo();
    }

    /**
     * @param MovieIndexRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Movie\Entities\Movie[]
     */
    public function latest(MovieIndexRequest $request)
    {
        return app(MovieService::class)->latestList($request);
    }

    /**
     * @param MovieIndexRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Movie\Entities\Movie[]
     */
    public function popular(MovieIndexRequest $request)
    {
        return app(MovieService::class)->popularList($request);
    }

    /**
     * @param MovieIndexRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Movie\Entities\Movie[]
     */
    public function hotTopic(MovieIndexRequest $request)
    {
        return app(MovieService::class)->hotTopicList($request, app(UrlParserUtil::class));
    }

    /**
     * @param MovieIndexRequest $request
     * @return int
     */
    public function total(MovieIndexRequest $request)
    {
        return app(MovieService::class)->total($request);
    }

    /**
     * @param MovieInfoRequest $request
     * @return \Modules\Movie\Entities\Movie
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function info(MovieInfoRequest $request)
    {
        return app(MovieService::class)->info($request->getId());
    }

    /**
     * @param MovieCommentsListRequest $request
     * @return \Modules\Movie\Entities\Movie|null
     */
    public function comments(MovieCommentsListRequest $request)
    {
        return app(MovieService::class)->commentsList($request, app(UrlParserUtil::class));
    }

    /**
     * @param MovieCommentsListRequest $request
     * @return int
     */
    public function commentsTotal(MovieCommentsListRequest $request)
    {
        return app(MovieService::class)->commentsTotal($request, app(UrlParserUtil::class));
    }

    /**
     * @param MovieInfoRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Source[]
     */
    public function source(MovieInfoRequest $request)
    {
        return app(MovieService::class)->source($request->getId());
    }

    /**
     * @param MovieInfoRequest $request
     * @return array
     */
    public function isFavorite(MovieInfoRequest $request)
    {
        return ['data' => app(MovieService::class)->isFavorite($request, \Auth::guard()->user())];
    }

    /**
     * @return array
     */
    public function options()
    {
        return [
            'genres'   => app(GenresSettingRepo::class)->getEnableUsedType(ClassifiedConstant::MOVIE),
            'region'   => app(RegionRepo::class)->getEnableByUsedType(ClassifiedConstant::MOVIE),
            'years'    => app(YearsSettingRepo::class)->getEnableByType(ClassifiedConstant::MOVIE),
            'language' => app(LanguageSettingRepo::class)->getAllByUsedType(ClassifiedConstant::MOVIE)
        ];
    }
}
