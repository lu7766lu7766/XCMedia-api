<?php

namespace Modules\ShortFilm\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\AVActressRepo;
use Modules\Classified\Repositories\CupRepo;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;
use Modules\ShortFilm\Http\Requests\AddRequestHandle;
use Modules\ShortFilm\Http\Requests\DeleteRequestHandle;
use Modules\ShortFilm\Http\Requests\EditRequestHandle;
use Modules\ShortFilm\Http\Requests\EditVideoRequestHandle;
use Modules\ShortFilm\Http\Requests\ListRequestHandle;
use Modules\ShortFilm\Http\Requests\TotalRequestHandle;
use Modules\ShortFilm\Services\ManageShortFilmService;

class ManageShortFilmController extends Controller
{
    /** @var string */
    private $type;

    /**
     * ManageComicController constructor.
     */
    public function __construct()
    {
        $this->type = ClassifiedConstant::SHORT_FILM;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\ShortFilm\Entities\ShortFilm[]
     */
    public function list(ListRequestHandle $request)
    {
        return app(ManageShortFilmService::class)->list($request);
    }

    /**
     * @param TotalRequestHandle $request
     * @return int
     */
    public function total(TotalRequestHandle $request)
    {
        return app(ManageShortFilmService::class)->total($request);
    }

    /**
     * @param AddRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\ShortFilm\Entities\ShortFilm
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function add(AddRequestHandle $request, Cloud $cloud)
    {
        return app(ManageShortFilmService::class)->add($request, $cloud);
    }

    /**
     * @param EditRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\ShortFilm\Entities\ShortFilm
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function edit(EditRequestHandle $request, Cloud $cloud)
    {
        return app(ManageShortFilmService::class)->edit($request, $cloud);
    }

    /**
     * @param DeleteRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\ShortFilm\Entities\ShortFilm
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request, Cloud $cloud)
    {
        return app(ManageShortFilmService::class)->delete($request, $cloud);
    }

    /**
     * @param EditVideoRequestHandle $request
     * @param Cloud $cloud
     * @return \Modules\ShortFilm\Entities\ShortFilm|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function editVideo(EditVideoRequestHandle $request, Cloud $cloud)
    {
        return app(ManageShortFilmService::class)->video($request, $cloud);
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
