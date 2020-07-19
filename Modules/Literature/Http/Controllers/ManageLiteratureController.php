<?php

namespace Modules\Literature\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;
use Modules\Literature\Http\Requests\AddRequestHandle;
use Modules\Literature\Http\Requests\CountRequestHandle;
use Modules\Literature\Http\Requests\DeleteRequestHandle;
use Modules\Literature\Http\Requests\ListRequestHandle;
use Modules\Literature\Http\Requests\UpdateRequestHandle;
use Modules\Literature\Services\LiteratureService;

class ManageLiteratureController extends Controller
{
    /** @var string $type */
    private $type;

    public function __construct()
    {
        $this->type = ClassifiedConstant::LITERATURE;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Literature\Entities\Literature[]
     */
    public function list(ListRequestHandle $request)
    {
        return app(LiteratureService::class)->list($request);
    }

    /**
     * @param AddRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\Literature\Entities\Literature
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function add(AddRequestHandle $request, Cloud $cloud)
    {
        return app(LiteratureService::class)->add($request, $cloud);
    }

    /**
     * @param UpdateRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\Literature\Entities\Literature
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function edit(UpdateRequestHandle $request, Cloud $cloud)
    {
        return app(LiteratureService::class)->update($request, $cloud);
    }

    /**
     * @param DeleteRequestHandle $request
     * @param Cloud $cloud
     * @return string
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request, Cloud $cloud)
    {
        return app(LiteratureService::class)->delete($request, $cloud);
    }

    /**
     * @param CountRequestHandle $request
     * @return int
     */
    public function count(CountRequestHandle $request)
    {
        return app(LiteratureService::class)->count($request);
    }

    /**
     * @param UploadImageRequestHandle $request
     * @return \Modules\Files\Entities\EditorFiles|null
     */
    public function uploadImage(UploadImageRequestHandle $request)
    {
        return app(EditorFileUploadService::class)->upload($request->getImage());
    }

    /**
     * @param RemoveImageRequestHandle $request
     * @return int
     */
    public function removeImage(RemoveImageRequestHandle $request)
    {
        return app(EditorFileUploadService::class)->remove($request->getImageId());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Region[]
     */
    public function getRegion()
    {
        return app(RegionRepo::class)->getEnableByUsedType($this->type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Years[]
     */
    public function getYears()
    {
        return app(YearsSettingRepo::class)->getEnableByType($this->type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Genres[]
     */
    public function getGenres()
    {
        return app(GenresSettingRepo::class)->getEnableUsedType($this->type);
    }
}
