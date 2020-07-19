<?php

namespace Modules\Collector\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Collector\Http\Requests\GetIdRequestHandle;
use Modules\Collector\Http\Requests\ListRequestHandle;
use Modules\Collector\Http\Requests\StoreRequestHandle;
use Modules\Collector\Http\Requests\UpdateRequestHandle;
use Modules\Collector\Repositories\CollectorPlatformRepo;
use Modules\Collector\Repositories\CollectorSourceRepo;
use Modules\Collector\Repositories\CollectorTypeRepo;
use Modules\Collector\Services\ManageCollectorSettingService;

class ManageCollectorController extends Controller
{
    /** @var ManageCollectorSettingService $service */
    private $service;

    /**
     * ManageCollectorController constructor.
     */
    public function __construct()
    {
        $this->service = new ManageCollectorSettingService();
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Collector\Entities\CollectorSetting[]
     */
    public function index(ListRequestHandle $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param StoreRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        return $this->service->add($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Modules\Collector\Entities\CollectorSetting|null
     */
    public function edit(GetIdRequestHandle $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Modules\Collector\Entities\CollectorSetting|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        return $this->service->update($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return int
     */
    public function delete(GetIdRequestHandle $request)
    {
        return $this->service->delete($request);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Collector\Entities\CollectorSource[]
     */
    public function source()
    {
        return app(CollectorSourceRepo::class)->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Collector\Entities\CollectorType[]
     */
    public function type()
    {
        return app(CollectorTypeRepo::class)->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Collector\Entities\CollectorPlatform[]
     */
    public function platform()
    {
        return app(CollectorPlatformRepo::class)->all();
    }
}
