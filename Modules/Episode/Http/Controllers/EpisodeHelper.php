<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/12
 * Time: 下午 02:24
 */

namespace Modules\Episode\Http\Controllers;

use Modules\Classified\Repositories\SourceSettingRepo;
use Modules\Episode\Contracts\IEpisodeOwnerRepo;
use Modules\Episode\Entities\Episode;
use Modules\Episode\Http\Requests\BatchStoreRequestHandle;
use Modules\Episode\Http\Requests\GetEpisodeIdRequestHandle;
use Modules\Episode\Http\Requests\ListRequestHandle;
use Modules\Episode\Http\Requests\StoreRequestHandle;
use Modules\Episode\Http\Requests\UpdateRequestHandle;
use Modules\Episode\Services\EpisodeService;

trait EpisodeHelper
{
    /** @var EpisodeService $episodeService */
    private $episodeService;

    /**
     * EpisodeHelper constructor.
     */
    public function __construct()
    {
        $this->episodeService = new EpisodeService(
            $this->getEpisodeOwnerRepo(),
            new SourceSettingRepo($this->getUsedType())
        );
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|Episode[]
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function episodeList(ListRequestHandle $request)
    {
        return $this->episodeService->list($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function episodeTotal(ListRequestHandle $request)
    {
        return $this->episodeService->total($request);
    }

    /**
     * @param StoreRequestHandle $request
     * @return Episode|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function episodeCreate(StoreRequestHandle $request)
    {
        return $this->episodeService->store($request);
    }

    /**
     * @param GetEpisodeIdRequestHandle $request
     * @return Episode|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function episodeEdit(GetEpisodeIdRequestHandle $request)
    {
        return $this->episodeService->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return Episode|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function episodeUpdate(UpdateRequestHandle $request)
    {
        return $this->episodeService->update($request);
    }

    /**
     * @param GetEpisodeIdRequestHandle $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function episodeDelete(GetEpisodeIdRequestHandle $request)
    {
        return $this->episodeService->delete($request);
    }

    /**
     * @param BatchStoreRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function episodeBatchUpdateOrCreate(BatchStoreRequestHandle $request)
    {
        return $this->episodeService->batchStore($request);
    }

    /**
     * @return IEpisodeOwnerRepo
     */
    abstract public function getEpisodeOwnerRepo(): IEpisodeOwnerRepo;

    /**
     * @return string
     */
    abstract public function getUsedType(): string;
}
