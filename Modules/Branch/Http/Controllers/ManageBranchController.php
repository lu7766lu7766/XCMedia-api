<?php

namespace Modules\Branch\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Branch\Http\Requests\DeleteRequestHandle;
use Modules\Branch\Http\Requests\ListRequestHandle;
use Modules\Branch\Http\Requests\StoreRequestHandle;
use Modules\Branch\Http\Requests\UpdateRequestHandle;
use Modules\Branch\Services\ManageBranchService;

class ManageBranchController extends Controller
{
    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Branch\Entities\Branch[]
     */
    public function index(ListRequestHandle $request)
    {
        return app(ManageBranchService::class)->list($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return app(ManageBranchService::class)->total($request);
    }

    /**
     * @param StoreRequestHandle $request
     * @return \Modules\Branch\Entities\Branch|null
     */
    public function store(StoreRequestHandle $request)
    {
        return app(ManageBranchService::class)->add($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Modules\Branch\Repositories\BranchRepo|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        return app(ManageBranchService::class)->update($request);
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     */
    public function delete(DeleteRequestHandle $request)
    {
        return app(ManageBranchService::class)->delete($request);
    }
}
