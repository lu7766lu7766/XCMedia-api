<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/11
 * Time: 下午 06:29
 */

namespace Modules\Episode\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Contracts\ISourceProvider;
use Modules\Classified\Entities\Source;
use Modules\Episode\Constants\EpisodeKeys;
use Modules\Episode\Contracts\IEpisodeOwnerRepo;
use Modules\Episode\Entities\Episode;
use Modules\Episode\Http\Requests\BatchStoreRequestHandle;
use Modules\Episode\Http\Requests\GetEpisodeIdRequestHandle;
use Modules\Episode\Http\Requests\ListRequestHandle;
use Modules\Episode\Http\Requests\StoreRequestHandle;
use Modules\Episode\Http\Requests\UpdateRequestHandle;
use Modules\Episode\Repositories\EpisodeSourceRepo;
use Modules\Episode\Repositories\OwnerEpisodeRepo;

class EpisodeService
{
    /** @var OwnerEpisodeRepo $repo */
    private $repo;
    /** @var ISourceProvider $sourceProvider */
    private $sourceProvider;
    /** @var IEpisodeOwnerRepo $ownerRepo */
    private $ownerRepo;

    /**
     * EpisodeService constructor.
     * @param IEpisodeOwnerRepo $ownerRepo
     * @param ISourceProvider $sourceProvider
     */
    public function __construct(IEpisodeOwnerRepo $ownerRepo, ISourceProvider $sourceProvider)
    {
        $this->ownerRepo = $ownerRepo;
        $this->repo = new OwnerEpisodeRepo();
        $this->sourceProvider = $sourceProvider;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|Episode[]
     * @throws ApiErrorCodeException
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $this->getOwner($request->getEpisodeOwnerId()),
            $request->getPage(),
            $request->getPerpage())->load('sources');
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     * @throws ApiErrorCodeException
     */
    public function total(ListRequestHandle $request)
    {
        return $this->repo->count($this->getOwner($request->getEpisodeOwnerId()));
    }

    /**
     * @param StoreRequestHandle $request
     * @return Episode|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        $result = null;
        $sources = $this->checkSources($request->getSourcesUrl());
        \DB::transaction(function () use ($request, $sources, &$result) {
            $attribute = [
                'title'        => $request->getTitle(),
                'opening_time' => $request->getOpeningTime(),
                'status'       => $request->getStatus()
            ];
            $episode = $this->repo->create($this->getOwner($request->getEpisodeOwnerId()), $attribute);
            $episode_sources = $this->mapEpisodeSources(
                $sources,
                $episode,
                $episode->getKey(),
                $request->getSourcesUrl()
            );
            app(EpisodeSourceRepo::class)->create($episode_sources);
            $result = $episode->load('sources');
        });

        return $result;
    }

    /**
     * @param BatchStoreRequestHandle $request
     * @return Collection
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function batchStore(BatchStoreRequestHandle $request)
    {
        $source = $this->sourceProvider->find($request->getSourceId(), NYEnumConstants::YES);
        if (is_null($source)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Source not found');
        }
        $result = Collection::make();
        \DB::transaction(function () use ($request, $source, &$result) {
            $owner = $this->getOwner($request->getEpisodeOwnerId());
            $details = Collection::make($request->getData());
            $titles = $details->pluck(EpisodeKeys::TITLE)->toArray();
            if ($this->repo->isAlreadyExist($owner, $source->getKey(), $titles)) {
                throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'Episode already exist.');
            }
            foreach ($titles as $title) {
                $bondDetail = $details->filter(function ($detail) use ($title) {
                    return $title == $detail[EpisodeKeys::TITLE];
                })->first();
                $result->add($this->repo->batchSync(
                    $owner,
                    $source,
                    $title,
                    $request->getOpeningTime(),
                    $request->getStatus(),
                    $bondDetail[EpisodeKeys::URL]
                ));
            }
        });

        return $result;
    }

    /**
     * @param GetEpisodeIdRequestHandle $request
     * @return Episode|null
     * @throws ApiErrorCodeException
     */
    public function edit(GetEpisodeIdRequestHandle $request)
    {
        $episode = $this->repo->find($this->getOwner($request->getEpisodeOwnerId()), $request->getEpisodeId());
        if (is_null($episode)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }

        return $episode->load('sources');
    }

    /**
     * @param UpdateRequestHandle $request
     * @return Episode|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        $episode = $this->repo->find($this->getOwner($request->getEpisodeOwnerId()), $request->getEpisodeId());
        if (is_null($episode)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $result = null;
        $sources = $this->checkSources($request->getSourcesUrl());
        \DB::transaction(function () use ($request, $sources, $episode, &$result) {
            $attribute = [
                'title'        => $request->getTitle(),
                'opening_time' => $request->getOpeningTime(),
                'status'       => $request->getStatus()
            ];
            $episode_sources = $this->mapEpisodeSources(
                $sources,
                $episode,
                $episode->getKey(),
                $request->getSourcesUrl()
            );
            $episode->update($attribute);
            $episode->sources()->detach();
            app(EpisodeSourceRepo::class)->create($episode_sources);
            $result = $episode->load('sources');
        });

        return $result;
    }

    /**
     * @param GetEpisodeIdRequestHandle $request
     * @return int
     * @throws ApiErrorCodeException
     */
    public function delete(GetEpisodeIdRequestHandle $request)
    {
        return $this->repo->delete($this->getOwner($request->getEpisodeOwnerId()), $request->getEpisodeId());
    }

    /**
     * @param array $source
     * @return Collection|Source[]
     * @throws ApiErrorCodeException
     */
    private function checkSources(array $source)
    {
        $result = Collection::make();
        if (!empty($source)) {
            $sourceIds = array_keys($source);
            $result = $this->sourceProvider->getByIds($sourceIds);
            if ($result->isEmpty()) {
                throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
            }
        }

        return $result;
    }

    /**
     * @param Collection $sources
     * @param Episode $episode
     * @param int $episodeId
     * @param array $url
     * @return array
     */
    private function mapEpisodeSources(
        Collection $sources,
        Episode $episode,
        int $episodeId,
        array $url
    ) {
        return $sources->map(function (Source $item) use ($episode, $episodeId, $url) {
            return [
                'episode_id' => $episodeId,
                'source_id'  => $item->getKey(),
                'url'        => $url[$item->getKey()]
            ];
        })->toArray();
    }

    /**
     * @param int $episodeOwnerId
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws ApiErrorCodeException
     */
    private function getOwner(int $episodeOwnerId)
    {
        $owner = $this->ownerRepo->getOwner($episodeOwnerId);
        if (is_null($owner)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }

        return $owner;
    }
}
