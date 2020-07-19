<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/19
 * Time: 下午 03:40
 */

namespace Modules\Advertisement\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Modules\Advertisement\Entities\Advertisement;
use Modules\Advertisement\Entities\AdvertisementType;
use Modules\Advertisement\Http\Requests\Client\InfoRequest;
use Modules\Advertisement\Services\AdvertisementService;
use Modules\Base\Exception\ApiErrorCodeException;

class AdvertisementController extends Controller
{
    /** @var AdvertisementService $service */
    private $service;

    /**
     * AdvertisementController constructor.
     */
    public function __construct()
    {
        $this->service = app(AdvertisementService::class);
    }

    /**
     * @return AdvertisementType[]|Collection
     */
    public function index()
    {
        return $this->service->list();
    }

    /**
     * @param InfoRequest $request
     * @return Advertisement
     * @throws ApiErrorCodeException
     */
    public function info(InfoRequest $request)
    {
        return $this->service->info($request);
    }
}
