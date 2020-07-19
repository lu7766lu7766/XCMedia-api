<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/31
 * Time: 下午 05:43
 */

namespace Modules\Photograph\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Http\Requests\Years\GetIdRequestHandle;
use Modules\Classified\Http\Requests\Years\ListRequestHandle;
use Modules\Classified\Http\Requests\Years\StoreRequestHandle;
use Modules\Classified\Http\Requests\Years\UpdateRequestHandle;
use Modules\Classified\Service\YearsSettingService;

class YearsSettingController extends Controller
{
    /** @var YearsSettingService $service */
    private $service;

    public function __construct()
    {
        $this->service = new YearsSettingService(ClassifiedConstant::PHOTOGRAPH);
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
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
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function store(StoreRequestHandle $request)
    {
        return $this->service->create($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function edit(GetIdRequestHandle $request)
    {
        return $this->service->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
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
}
