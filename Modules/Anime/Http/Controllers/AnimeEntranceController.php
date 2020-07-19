<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 01:52
 */

namespace Modules\Anime\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Modules\Anime\Entities\Anime;
use Modules\Anime\Http\Requests\AnimeCommentListRequest;
use Modules\Anime\Http\Requests\AnimeCommentTotalRequest;
use Modules\Anime\Http\Requests\AnimeInfoRequest;
use Modules\Anime\Http\Requests\AnimeListRequest;
use Modules\Anime\Http\Requests\AnimeTotalRequest;
use Modules\Anime\Services\AnimeEntranceService;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Contracts\ILanguageProvider;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Classified\Repositories\SourceSettingRepo;
use Modules\Episode\Constants\EpisodeStatusConstants;
use Modules\Member\Repositories\MemberCommentRepo;
use XC\Independent\Kit\Utils\UrlParserUtil;

class AnimeEntranceController extends Controller
{
    /** @var AnimeEntranceService $service */
    private $service;

    /**
     * AnimeController constructor.
     * @param AnimeEntranceService $service
     */
    public function __construct(AnimeEntranceService $service)
    {
        $this->service = $service;
    }

    /**
     * @param AnimeListRequest $request
     * @return Collection|Anime[]
     */
    public function latestList(AnimeListRequest $request)
    {
        return $this->service->latestList($request);
    }

    /**
     * @param AnimeListRequest $request
     * @return Collection|Anime[]
     */
    public function popularList(AnimeListRequest $request)
    {
        return $this->service->popularList($request);
    }

    /**
     * @param AnimeListRequest $request
     * @param UrlParserUtil $url
     * @return Collection|Anime[]
     */
    public function mostComment(AnimeListRequest $request, UrlParserUtil $url)
    {
        return $this->service->mostComment($request, $url);
    }

    /**
     * @param AnimeTotalRequest $request
     * @return int
     */
    public function total(AnimeTotalRequest $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param AnimeInfoRequest $request
     * @return \Modules\Classified\Contracts\IClassifiedEntity
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function info(AnimeInfoRequest $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param IRegionProvider $repo
     * @return Collection|\Modules\Classified\Entities\Region[]
     */
    public function region(IRegionProvider $repo)
    {
        return $repo->getEnableByUsedType(ClassifiedConstant::ANIME);
    }

    /**
     * @param IYearsProvider $repo
     * @return Collection|Model[]
     */
    public function years(IYearsProvider $repo)
    {
        return $repo->getEnableByType(ClassifiedConstant::ANIME);
    }

    /**
     * @param IGenresProvider $repo
     * @return Collection|Model[]
     */
    public function genres(IGenresProvider $repo)
    {
        return $repo->getEnableUsedType(ClassifiedConstant::ANIME);
    }

    /**
     * @return array
     */
    public function status(): array
    {
        return EpisodeStatusConstants::enum();
    }

    /**
     * @param AnimeCommentListRequest $request
     * @param UrlParserUtil $util
     * @param MemberCommentRepo $repo
     * @return Collection|\Modules\Member\Pivots\MemberCommentPivot[]
     */
    public function commentList(AnimeCommentListRequest $request, UrlParserUtil $util, MemberCommentRepo $repo)
    {
        return $this->service->commentList($request, $util, $repo);
    }

    /**
     * @param AnimeCommentTotalRequest $request
     * @param UrlParserUtil $util
     * @param MemberCommentRepo $repo
     * @return int
     */
    public function commentTotal(AnimeCommentTotalRequest $request, UrlParserUtil $util, MemberCommentRepo $repo)
    {
        return $this->service->commentTotal($request, $util, $repo);
    }

    /**
     * @param AnimeInfoRequest $request
     * @return Collection|\Modules\Classified\Entities\Source[]
     */
    public function source(AnimeInfoRequest $request)
    {
        $repo = app(SourceSettingRepo::class, ['type' => ClassifiedConstant::ANIME]);

        return $this->service->episodeSource($request, $repo);
    }

    /**
     * @param AnimeInfoRequest $request
     * @return array
     */
    public function isFavorite(AnimeInfoRequest $request)
    {
        return ['data' => $this->service->isFavorite($request, \Auth::guard()->user())];
    }

    /**
     * @param ILanguageProvider $provider
     * @return Collection|Model[]
     */
    public function language(ILanguageProvider $provider)
    {
        return $provider->getAllByUsedType(ClassifiedConstant::ANIME);
    }
}
