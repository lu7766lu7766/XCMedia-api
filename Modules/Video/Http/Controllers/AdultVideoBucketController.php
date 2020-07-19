<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 03:15
 */

namespace Modules\Video\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Routing\Controller;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Video\Entities\AdultVideoBucket;
use Modules\Video\Http\Requests\Manage\AdultVideoBucketInfoRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoBucketStoreRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoBucketUpdateRequest;
use Modules\Video\Repositories\AdultVideoRepo;
use Modules\Video\Services\ManageAdultVideoBucketService;

class AdultVideoBucketController extends Controller
{
    /** @var ManageAdultVideoBucketService $service */
    private $service;

    /**
     * AdultVideoBucketController constructor.
     * @param ManageAdultVideoBucketService $service
     */
    public function __construct(ManageAdultVideoBucketService $service)
    {
        $this->service = $service;
    }

    /**
     * @param AdultVideoBucketInfoRequest $request
     * @return AdultVideoBucket
     * @throws ApiErrorCodeException
     */
    public function info(AdultVideoBucketInfoRequest $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param AdultVideoBucketStoreRequest $request
     * @param Cloud $cloud
     * @param AdultVideoRepo $repo
     * @return AdultVideoBucket
     * @throws ApiErrorCodeException
     */
    public function store(AdultVideoBucketStoreRequest $request, Cloud $cloud, AdultVideoRepo $repo)
    {
        return $this->service->create($request, $cloud, $repo);
    }

    /**
     * @param AdultVideoBucketUpdateRequest $request
     * @param Cloud $cloud
     * @return AdultVideoBucket
     * @throws ApiErrorCodeException
     */
    public function update(AdultVideoBucketUpdateRequest $request, Cloud $cloud)
    {
        return $this->service->update($request, $cloud);
    }
}
