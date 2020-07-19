<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/10
 * Time: 下午 06:00
 */

namespace Modules\Comic\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Topic\Constants\TopicConstant;
use Modules\Topic\Entities\Topic;
use Modules\Topic\Http\Requests\GetIdRequestHandle;
use Modules\Topic\Http\Requests\ListRequestHandle;
use Modules\Topic\Http\Requests\StoreRequestHandle;
use Modules\Topic\Http\Requests\UpdateRequestHandle;
use Modules\Topic\Service\TopicTypeService;

class TopicTypeController extends Controller
{
    /** @var TopicTypeService $service */
    private $service;

    /**
     * TopicSettingController constructor.
     */
    public function __construct()
    {
        $this->service = app(TopicTypeService::class, ['type' => TopicConstant::COMIC]);
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|Topic[]
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
     * @return Topic|null
     */
    public function store(StoreRequestHandle $request)
    {
        return $this->service->create($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Topic|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function edit(GetIdRequestHandle $request)
    {
        return $this->service->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return Topic|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        return $this->service->update($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(GetIdRequestHandle $request)
    {
        return $this->service->delete($request);
    }
}
