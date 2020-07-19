<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 01:55
 */

namespace Modules\Anime\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Anime\Entities\Anime;
use Modules\Anime\Http\Requests\AnimeCommentListRequest;
use Modules\Anime\Http\Requests\AnimeCommentTotalRequest;
use Modules\Anime\Http\Requests\AnimeInfoRequest;
use Modules\Anime\Http\Requests\AnimeListRequest;
use Modules\Anime\Http\Requests\AnimeTotalRequest;
use Modules\Anime\Repositories\AnimeRepo;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Contracts\ISourceProvider;
use Modules\Member\Pivots\MemberCommentPivot;
use Modules\Member\Repositories\MemberCommentRepo;
use XC\Independent\Kit\Utils\UrlParserUtil;

class AnimeEntranceService
{
    /** @var AnimeRepo $repo */
    private $repo;

    /**
     * AnimeService constructor.
     * @param AnimeRepo $repo
     */
    public function __construct(AnimeRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param AnimeListRequest $request
     * @return Collection|Anime[]
     */
    public function latestList(AnimeListRequest $request)
    {
        return $this->repo->enableBook(
            $request->getRegionId(),
            $request->getGenresIds(),
            $request->getYearsId(),
            $request->getEpisodeStatus(),
            $request->getLanguageId(),
            $request->getPage(),
            $request->getPerpage(),
            'id'
        )->load([
            'episodes' => function (Relation $query) {
                $query->where('status', NYEnumConstants::YES)->where('opening_time', '<=', Carbon::now());
            }
        ]);
    }

    /**
     * @param AnimeListRequest $request
     * @return Collection|Anime[]
     */
    public function popularList(AnimeListRequest $request)
    {
        return $this->repo->enableBook(
            $request->getRegionId(),
            $request->getGenresIds(),
            $request->getYearsId(),
            $request->getEpisodeStatus(),
            $request->getLanguageId(),
            $request->getPage(),
            $request->getPerpage(),
            'views'
        )->load(([
            'episodes' => function (Relation $query) {
                $query->where('status', NYEnumConstants::YES)->where('opening_time', '<=', Carbon::now());
            }
        ]));
    }

    /**
     * @param AnimeListRequest $request
     * @param UrlParserUtil $url
     * @return Collection|Anime[]
     */
    public function mostComment(AnimeListRequest $request, UrlParserUtil $url)
    {
        return $this->repo->mostCommented(
            $request->getRegionId(),
            $request->getGenresIds(),
            $request->getYearsId(),
            $request->getEpisodeStatus(),
            $request->getPage(),
            $request->getPerpage(),
            $url->host()
        )->load('episodes');
    }

    /**
     * @param AnimeInfoRequest $request
     * @return \Modules\Classified\Contracts\IClassifiedEntity
     * @throws ApiErrorCodeException
     */
    public function info(AnimeInfoRequest $request)
    {
        $anime = $this->repo->findEnable($request->getId());
        if (is_null($anime)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ANIME MODEL NOT FOUND');
        }
        $anime->increment('views');

        return $anime->load(['region', 'years', 'genres']);
    }

    /**
     * @param AnimeTotalRequest $request
     * @return int
     */
    public function total(AnimeTotalRequest $request)
    {
        return $this->repo->countEnable(
            $request->getRegionId(),
            $request->getGenresIds(),
            $request->getYearsId(),
            $request->getEpisodeStatus()
        );
    }

    /**
     * @param AnimeCommentListRequest $request
     * @param UrlParserUtil $util
     * @param MemberCommentRepo $repo
     * @return Collection|MemberCommentPivot[]
     */
    public function commentList(
        AnimeCommentListRequest $request,
        UrlParserUtil $util,
        MemberCommentRepo $repo
    ) {
        return $repo->animeEnableBook(
            $util->host(),
            $request->getId(),
            $request->getPage(),
            $request->getPerpage()
        )->load('member:id,account,display_name');
    }

    /**
     * @param AnimeCommentTotalRequest $request
     * @param UrlParserUtil $util
     * @param MemberCommentRepo $repo
     * @return int
     */
    public function commentTotal(AnimeCommentTotalRequest $request, UrlParserUtil $util, MemberCommentRepo $repo)
    {
        return $repo->countAnimeEnable($util->host(), $request->getId());
    }

    /**
     * @param AnimeInfoRequest $request
     * @param ISourceProvider $repo
     * @return Collection|\Modules\Classified\Entities\Source[]
     */
    public function episodeSource(AnimeInfoRequest $request, ISourceProvider $repo)
    {
        return $repo->getEnableOnlineByMedia(Anime::class, $request->getId())
            ->load([
                'quote' => function (BelongsToMany $query) use ($request) {
                    $query->where('opening_time', '<=', Carbon::now())
                        ->where('status', NYEnumConstants::YES)
                        ->whereHasMorph('series', Anime::class, function (Builder $query) use ($request) {
                            $query->whereKey($request->getId());
                        });
                }
            ]);
    }

    /**
     * @param AnimeInfoRequest $request
     * @param Authenticatable $auth
     * @return bool
     */
    public function isFavorite(AnimeInfoRequest $request, Authenticatable $auth)
    {
        return $this->repo->isFavoriteByMember($request->getId(), $auth->getAuthIdentifier());
    }
}
