<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/4
 * Time: 下午 04:06
 */

namespace Modules\Classified\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\RegionUsedTypeConstants;
use Modules\Classified\Entities\Region;
use Modules\Classified\Http\Requests\Region\RegionIndexRequest;
use Modules\Classified\Http\Requests\Region\RegionInfoRequest;
use Modules\Classified\Http\Requests\Region\RegionStoreRequest;
use Modules\Classified\Http\Requests\Region\RegionTotalRequest;
use Modules\Classified\Http\Requests\Region\RegionUpdateRequest;
use Modules\Classified\Service\RegionSettingService;

trait MediaRegion
{
    /**
     * @return string
     * @see RegionUsedTypeConstants
     */
    abstract protected function genre(): string;

    /** @var RegionSettingService $service */
    private $service;

    /**
     * RegionSettingController constructor.
     */
    public function __construct()
    {
        $this->service = app(RegionSettingService::class, ['usedType' => $this->genre()]);
    }

    /**
     * @param RegionIndexRequest $request
     * @return Collection|Region[]
     */
    public function index(RegionIndexRequest $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param RegionTotalRequest $request
     * @return int
     */
    public function total(RegionTotalRequest $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param RegionInfoRequest $request
     * @return Region|null
     * @throws ApiErrorCodeException
     */
    public function info(RegionInfoRequest $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param RegionStoreRequest $request
     * @return Region
     * @throws ApiErrorCodeException
     */
    public function store(RegionStoreRequest $request)
    {
        return $this->service->create($request);
    }

    /**
     * @param RegionUpdateRequest $request
     * @return Region
     * @throws ApiErrorCodeException
     */
    public function update(RegionUpdateRequest $request)
    {
        return $this->service->update($request);
    }

    /**
     * @param RegionInfoRequest $request
     * @return Region
     * @throws ApiErrorCodeException
     */
    public function delete(RegionInfoRequest $request)
    {
        return $this->service->delete($request);
    }
}
