<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 05:00
 */

namespace Modules\Photograph\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Modules\Classified\Constants\AVActressUsedTypeConstants;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Constants\CupUsedTypeConstants;
use Modules\Classified\Constants\RegionUsedTypeConstants;
use Modules\Classified\Contracts\IActressProvider;
use Modules\Classified\Contracts\ICupProvider;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Photograph\Entities\PhotographAlbum;
use Modules\Photograph\Http\Requests\Photograph\ManageIndexRequest;
use Modules\Photograph\Http\Requests\Photograph\ManageInfoRequest;
use Modules\Photograph\Http\Requests\Photograph\ManageStoreRequest;
use Modules\Photograph\Http\Requests\Photograph\ManageTotalRequest;
use Modules\Photograph\Http\Requests\Photograph\ManageUpdateRequest;
use Modules\Photograph\Services\PhotographyManageService;

class PhotographyManageController extends Controller
{
    /** @var PhotographyManageService $service */
    private $service;

    /**
     * PhotoManageController constructor.
     * @param PhotographyManageService $service
     */
    public function __construct(PhotographyManageService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ManageIndexRequest $request
     * @return Collection|PhotographAlbum[]
     */
    public function index(ManageIndexRequest $request): Collection
    {
        return $this->service->list($request);
    }

    /**
     * @param ManageTotalRequest $request
     * @return int
     */
    public function total(ManageTotalRequest $request): int
    {
        return $this->service->total($request);
    }

    /**
     * @param ManageInfoRequest $request
     * @return PhotographAlbum
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function info(ManageInfoRequest $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param ManageStoreRequest $request
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @param IYearsProvider $yearsProvider
     * @param Cloud $cloud
     * @return PhotographAlbum
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function store(
        ManageStoreRequest $request,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider,
        IYearsProvider $yearsProvider,
        Cloud $cloud
    ) {
        return $this->service->create(
            $request,
            $regionProvider,
            $actressProvider,
            $cupProvider,
            $genresProvider,
            $yearsProvider,
            $cloud
        );
    }

    /**
     * @param ManageUpdateRequest $request
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @param IYearsProvider $yearsProvider
     * @param Cloud $cloud
     * @return PhotographAlbum
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(
        ManageUpdateRequest $request,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider,
        IYearsProvider $yearsProvider,
        Cloud $cloud
    ): PhotographAlbum {
        return $this->service->update(
            $request,
            $regionProvider,
            $actressProvider,
            $cupProvider,
            $genresProvider,
            $yearsProvider,
            $cloud
        );
    }

    /**
     * @param ManageInfoRequest $request
     * @param Cloud $cloud
     * @return PhotographAlbum
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(ManageInfoRequest $request, Cloud $cloud)
    {
        return $this->service->delete($request, $cloud);
    }


    /**
     * @param IRegionProvider $repo
     * @return Collection|Model[]
     */
    public function region(IRegionProvider $repo): Collection
    {
        return $repo->getEnableByUsedType(RegionUsedTypeConstants::PHOTOGRAPH);
    }

    /**
     * @param IActressProvider $repo
     * @return Collection|Model[]
     */
    public function actress(IActressProvider $repo): Collection
    {
        return $repo->getEnableByUsedType(AVActressUsedTypeConstants::PHOTOGRAPH);
    }

    /**
     * @param ICupProvider $repo
     * @return Collection|Model[]
     */
    public function cup(ICupProvider $repo): Collection
    {
        return $repo->getEnableByUsedType(CupUsedTypeConstants::PHOTOGRAPH);
    }

    /**
     * @param IGenresProvider $repo
     * @return Collection|Model[]
     */
    public function genres(IGenresProvider $repo): Collection
    {
        return $repo->getEnableUsedType(ClassifiedConstant::PHOTOGRAPH);
    }

    /**
     * @param IYearsProvider $repo
     * @return Collection|Model[]
     */
    public function years(IYearsProvider $repo): Collection
    {
        return $repo->getEnableByType(ClassifiedConstant::PHOTOGRAPH);
    }
}
