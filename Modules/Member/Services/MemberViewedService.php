<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/5
 * Time: 下午 04:57
 */

namespace Modules\Member\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Episode\Constants\EpisodeMediaMorphConstants;
use Modules\Episode\Contracts\Entire\IEpisode;
use Modules\Episode\Contracts\IEpisodeProvider;
use Modules\Member\Entities\MediaViewed;
use Modules\Member\Entities\Member;
use Modules\Member\Http\Requests\Client\MemberViewed\EpisodeClearRequest;
use Modules\Member\Http\Requests\Client\MemberViewed\EpisodeIndexRequest;
use Modules\Member\Http\Requests\Client\MemberViewed\EpisodeStoreRequest;
use Modules\Member\Http\Requests\Client\MemberViewed\EpisodeTotalRequest;
use Modules\Member\Repositories\MemberViewedRepo;

class MemberViewedService
{
    /** @var Member $observer */
    private $observer;
    /** @var MemberViewedRepo $repo */
    private $repo;

    /**
     * MemberViewedService constructor.
     * @param Member $member
     * @param MemberViewedRepo $repo
     */
    public function __construct(Member $member, MemberViewedRepo $repo)
    {
        $this->observer = $member;
        $this->repo = $repo;
    }

    /**
     * @param EpisodeIndexRequest $request
     * @return Collection|MediaViewed[]
     */
    public function episodeList(EpisodeIndexRequest $request)
    {
        return $this->repo->episodeEnableBook(
            $request->getPage(),
            $request->getPerpage(),
            $this->observer->getAuthIdentifier(),
            EpisodeMediaMorphConstants::mapping($request->getType())
        )->load(['readAble.sources', 'readAble.series']);
    }

    /**
     * @param EpisodeTotalRequest $request
     * @return int
     */
    public function episodeTotal(EpisodeTotalRequest $request): int
    {
        return $this->repo->countEpisode(
            $this->observer->getAuthIdentifier(),
            EpisodeMediaMorphConstants::mapping($request->getType())
        );
    }

    /**
     * @param EpisodeClearRequest $request
     * @return int
     * @throws ApiErrorCodeException
     */
    public function episodeClear(EpisodeClearRequest $request): int
    {
        $count = $this->repo->deleteEpisode(
            $this->observer->getAuthIdentifier(),
            $request->getId(),
            EpisodeMediaMorphConstants::mapping($request->getType())
        );
        if ($count == 0) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'UPDATE　MEMBER VIEWED FAILED');
        }

        return $count;
    }

    /**
     * @param EpisodeStoreRequest $request
     * @param IEpisodeProvider $repo
     * @return IEpisode|null
     * @throws ApiErrorCodeException
     */
    public function episodeCreate(EpisodeStoreRequest $request, IEpisodeProvider $repo)
    {
        $episode = $repo->findEnableByMediaType($request->getId());
        if (is_null($episode)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'EPISODE NOT FOUND');
        }
        $series = $episode->series;
        try {
            $seriesEpisodes = $repo->getBySeriesId($series->getKey());
            \DB::transaction(function () use ($episode, $seriesEpisodes) {
                $episode->increment('views');
                $this->observer->viewedEpisode()->detach($seriesEpisodes);
                $this->observer->viewedEpisode()->save($episode);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'CREATE EPISODE VIEWED FAIL');
        }

        return $episode;
    }
}
