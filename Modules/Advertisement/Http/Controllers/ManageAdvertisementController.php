<?php

namespace Modules\Advertisement\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Advertisement\Http\Requests\DeleteRequestHandle;
use Modules\Advertisement\Http\Requests\EditRequestHandle;
use Modules\Advertisement\Http\Requests\ListRequestHandle;
use Modules\Advertisement\Http\Requests\StoreRequestHandle;
use Modules\Advertisement\Http\Requests\UpdateRequestHandle;
use Modules\Advertisement\Repositories\AdvertisementTypeRepo;
use Modules\Advertisement\Services\ManageAdvertisementService;
use Modules\Branch\Repositories\BranchRepo;

class ManageAdvertisementController extends Controller
{
    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Advertisement\Entities\Advertisement[]
     */
    public function index(ListRequestHandle $request)
    {
        return app(ManageAdvertisementService::class)->list($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return app(ManageAdvertisementService::class)->total($request);
    }

    /**
     * @param StoreRequestHandle $request
     * @return \Modules\Advertisement\Entities\Advertisement|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        return app(ManageAdvertisementService::class)->create($request);
    }

    /**
     * @param EditRequestHandle $request
     * @return \Modules\Advertisement\Entities\Advertisement|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function edit(EditRequestHandle $request)
    {
        return app(ManageAdvertisementService::class)->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        return app(ManageAdvertisementService::class)->update($request);
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request)
    {
        return app(ManageAdvertisementService::class)->delete($request);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Branch\Entities\Branch[]
     */
    public function branch()
    {
        return app(BranchRepo::class)->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Advertisement\Entities\AdvertisementType[]
     */
    public function type()
    {
        return app(AdvertisementTypeRepo::class)->all();
    }
}
