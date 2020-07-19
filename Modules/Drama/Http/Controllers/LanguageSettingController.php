<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/4
 * Time: 下午 02:50
 */

namespace Modules\Drama\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Http\Requests\Language\GetIdRequestHandle;
use Modules\Classified\Http\Requests\Language\ListRequestHandle;
use Modules\Classified\Http\Requests\Language\StoreRequestHandle;
use Modules\Classified\Http\Requests\Language\UpdateRequestHandle;
use Modules\Classified\Service\LanguageSettingService;

class LanguageSettingController extends Controller
{
    /** @var LanguageSettingService $service */
    private $service;

    public function __construct()
    {
        $this->service = new LanguageSettingService(ClassifiedConstant::DRAMA);
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
