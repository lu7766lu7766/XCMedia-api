<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/26
 * Time: 下午 07:41
 */

namespace Modules\Selfie\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Classified\Contracts\IActressProvider;
use Modules\Classified\Contracts\ICupProvider;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Selfie\Entities\SelfieSchedule;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\IndexRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\InfoRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\StoreRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\TotalRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\UpdateRequest;
use Modules\Selfie\Services\ManageSelfieScheduleService;

class ManageSelfieScheduleController extends Controller
{
    /** @var ManageSelfieScheduleService $service */
    private $service;

    /**
     * ManageSelfieController constructor.
     * @param ManageSelfieScheduleService $service
     */
    public function __construct(ManageSelfieScheduleService $service)
    {
        $this->service = $service;
    }

    /**
     * @param IndexRequest $request
     * @return Collection|SelfieSchedule[]
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
     * @param StoreRequest $request
     * @param Cloud $cloud
     * @param IYearsProvider $yearsProvider
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @return SelfieSchedule
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function store(
        StoreRequest $request,
        Cloud $cloud,
        IYearsProvider $yearsProvider,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider
    ) {
        return $this->service->create(
            $request,
            $cloud,
            $yearsProvider,
            $regionProvider,
            $actressProvider,
            $cupProvider,
            $genresProvider
        );
    }

    /**
     * @param InfoRequest $request
     * @return SelfieSchedule
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function info(InfoRequest $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param UpdateRequest $request
     * @param Cloud $cloud
     * @param IYearsProvider $yearsProvider
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @return SelfieSchedule
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(
        UpdateRequest $request,
        Cloud $cloud,
        IYearsProvider $yearsProvider,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider
    ) {
        return $this->service->update(
            $request,
            $cloud,
            $yearsProvider,
            $regionProvider,
            $actressProvider,
            $cupProvider,
            $genresProvider
        );
    }

    /**
     * @param InfoRequest $request
     * @param Cloud $cloud
     * @return SelfieSchedule
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(InfoRequest $request, Cloud $cloud)
    {
        return $this->service->delete($request, $cloud);
    }

    /**
     * @param IGenresProvider $repo
     * @return Collection|Model[]
     */
    public function genres(IGenresProvider $repo)
    {
        return $this->service->genres($repo);
    }

    /**
     * @param IRegionProvider $repo
     * @return Collection|Model[]
     */
    public function region(IRegionProvider $repo)
    {
        return $this->service->region($repo);
    }

    /**
     * @param IActressProvider $repo
     * @return Collection|Model[]
     */
    public function actress(IActressProvider $repo)
    {
        return $this->service->actress($repo);
    }

    /**
     * @param ICupProvider $repo
     * @return Collection|Model[]
     */
    public function cup(ICupProvider $repo)
    {
        return $this->service->cup($repo);
    }

    /**
     * @param IYearsProvider $repo
     * @return Collection|Model[]
     */
    public function years(IYearsProvider $repo)
    {
        return $this->service->years($repo);
    }

    /**
     * @return array
     */
    public function status()
    {
        return NYEnumConstants::enum();
    }
}
