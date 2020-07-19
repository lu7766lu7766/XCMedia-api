<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 下午 07:26
 */

namespace Modules\Selfie\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Modules\Selfie\Entities\SelfieVideo;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\IndexRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\InfoRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\StoreRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\TotalRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\UpdateRequest;
use Modules\Selfie\Repositories\SelfieScheduleRepo;
use Modules\Selfie\Services\ManageSelfieVideoService;

class ManageSelfieVideoController extends Controller
{
    /** @var ManageSelfieVideoService $service */
    private $service;

    /**
     * ManageSelfieVideoController constructor.
     * @param ManageSelfieVideoService $service
     */
    public function __construct(ManageSelfieVideoService $service)
    {
        $this->service = $service;
    }

    /**
     * @param IndexRequest $request
     * @return Collection|SelfieVideo[]
     */
    public function index(IndexRequest $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param TotalRequest $request
     * @return int
     */
    public function total(TotalRequest $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param InfoRequest $request
     * @return SelfieVideo
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function info(InfoRequest $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param StoreRequest $request
     * @param Cloud $cloud
     * @param SelfieScheduleRepo $repo
     * @return SelfieVideo
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function store(StoreRequest $request, Cloud $cloud, SelfieScheduleRepo $repo)
    {
        return $this->service->create($request, $cloud, $repo);
    }

    /**
     * @param UpdateRequest $request
     * @param Cloud $cloud
     * @return SelfieVideo
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(UpdateRequest $request, Cloud $cloud)
    {
        return $this->service->update($request, $cloud);
    }

    /**
     * @param InfoRequest $request
     * @param Cloud $cloud
     * @return SelfieVideo
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(InfoRequest $request, Cloud $cloud)
    {
        return $this->service->delete($request, $cloud);
    }
}
