<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/5
 * Time: 下午 04:57
 */

namespace Modules\Member\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Episode\Constants\EpisodeMediaMorphConstants;
use Modules\Episode\Contracts\IEpisodeProvider;
use Modules\Member\Entities\MediaViewed;
use Modules\Member\Http\Requests\Client\MemberViewed\EpisodeClearRequest;
use Modules\Member\Http\Requests\Client\MemberViewed\EpisodeIndexRequest;
use Modules\Member\Http\Requests\Client\MemberViewed\EpisodeStoreRequest;
use Modules\Member\Http\Requests\Client\MemberViewed\EpisodeTotalRequest;
use Modules\Member\Services\MemberViewedService;

class MemberViewedController extends Controller
{
    /**
     * @param EpisodeIndexRequest $request
     * @return Collection|MediaViewed[]
     */
    public function episodeIndex(EpisodeIndexRequest $request)
    {
        return $this->service()->episodeList($request);
    }

    /**
     * @param EpisodeTotalRequest $request
     * @return int
     */
    public function episodeTotal(EpisodeTotalRequest $request): int
    {
        return $this->service()->episodeTotal($request);
    }

    /**
     * @param EpisodeClearRequest $request
     * @return int
     * @throws ApiErrorCodeException
     */
    public function episodeClear(EpisodeClearRequest $request): int
    {
        return $this->service()->episodeClear($request);
    }

    /**
     * @return array
     */
    public function episodeTypes(): array
    {
        return EpisodeMediaMorphConstants::enum();
    }

    /**
     * @return MemberViewedService
     */
    private function service(): MemberViewedService
    {
        return app(MemberViewedService::class, ['member' => \Auth::guard()->user()]);
    }

    /**
     * @param EpisodeStoreRequest $request
     * @param IEpisodeProvider $repo
     * @return \Modules\Episode\Contracts\Entire\IEpisode|null
     * @throws ApiErrorCodeException
     */
    public function episodeStore(EpisodeStoreRequest $request, IEpisodeProvider $repo)
    {
        return $this->service()->episodeCreate($request, $repo);
    }
}
