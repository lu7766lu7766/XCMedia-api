<?php

namespace Modules\FeatureFilm\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\AVActressRepo;
use Modules\Classified\Repositories\CupRepo;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\FeatureFilm\Http\Requests\AddRequestHandle;
use Modules\FeatureFilm\Http\Requests\DeleteRequestHandle;
use Modules\FeatureFilm\Http\Requests\EditRequestHandle;
use Modules\FeatureFilm\Http\Requests\EditVideoRequestHandle;
use Modules\FeatureFilm\Http\Requests\ListRequestHandle;
use Modules\FeatureFilm\Http\Requests\TotalRequestHandle;
use Modules\FeatureFilm\Services\ManageFeatureFilmService;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;

class ManageFeatureFilmController extends Controller
{
    /** @var string */
    private $type;

    /**
     * ManageComicController constructor.
     */
    public function __construct()
    {
        $this->type = ClassifiedConstant::FEATURE_FILM;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\FeatureFilm\Entities\FeatureFilm[]
     */
    public function list(ListRequestHandle $request)
    {
        return app(ManageFeatureFilmService::class)->list($request);
    }

    /**
     * @param TotalRequestHandle $request
     * @return int
     */
    public function total(TotalRequestHandle $request)
    {
        return app(ManageFeatureFilmService::class)->total($request);
    }

    /**
     * @param AddRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\FeatureFilm\Entities\FeatureFilm
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function add(AddRequestHandle $request, Cloud $cloud)
    {
        return app(ManageFeatureFilmService::class)->add($request, $cloud);
    }

    /**
     * @param EditRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\FeatureFilm\Entities\FeatureFilm
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function edit(EditRequestHandle $request, Cloud $cloud)
    {
        return app(ManageFeatureFilmService::class)->edit($request, $cloud);
    }

    /**
     * @param DeleteRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\FeatureFilm\Entities\FeatureFilm
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request, Cloud $cloud)
    {
        return app(ManageFeatureFilmService::class)->delete($request, $cloud);
    }

    /**
     * @param EditVideoRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\FeatureFilm\Entities\FeatureFilm|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function editVideo(EditVideoRequestHandle $request, Cloud $cloud)
    {
        return app(ManageFeatureFilmService::class)->video($request, $cloud);
    }

    /**
     * @param UploadImageRequestHandle $request
     * @return \Modules\Files\Entities\EditorFiles|null
     */
    public function uploadEditorFile(UploadImageRequestHandle $request)
    {
        return app(EditorFileUploadService::class)->upload($request->getImage());
    }

    /**
     * @param RemoveImageRequestHandle $request
     * @return int
     */
    public function deleteEditorFile(RemoveImageRequestHandle $request)
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

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\AVActress[]
     */
    public function getAVActress()
    {
        return app(AVActressRepo::class)->getEnableByUsedType($this->type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Cup[]
     */
    public function getCup()
    {
        return app(CupRepo::class)->getEnableByUsedType($this->type);
    }
}
