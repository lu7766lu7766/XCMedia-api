<?php

namespace Modules\Comic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Cloud;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Comic\Http\Requests\Manage\ComicEditRequest;
use Modules\Comic\Http\Requests\Manage\ComicEpisodeEditRequest;
use Modules\Comic\Http\Requests\Manage\ComicEpisodeInfoRequest;
use Modules\Comic\Http\Requests\Manage\ComicEpisodeListRequest;
use Modules\Comic\Http\Requests\Manage\ComicEpisodeUpdateRequest;
use Modules\Comic\Http\Requests\Manage\ComicIndexRequest;
use Modules\Comic\Http\Requests\Manage\ComicInfoRequest;
use Modules\Comic\Http\Requests\Manage\ComicUpdateRequest;
use Modules\Comic\Services\ManageComicEpisodeService;
use Modules\Comic\Services\ManageComicService;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;

class ManageComicController extends Controller
{
    /** @var string */
    private $type;

    /**
     * ManageComicController constructor.
     */
    public function __construct()
    {
        $this->type = ClassifiedConstant::COMIC;
    }

    /**
     * @param ComicIndexRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Comic\Entities\Comic[]
     */
    public function index(ComicIndexRequest $request)
    {
        return app(ManageComicService::class)->list($request);
    }

    /**
     * @param ComicIndexRequest $request
     * @return int
     */
    public function total(ComicIndexRequest $request)
    {
        return app(ManageComicService::class)->total($request);
    }

    /**
     * @param ComicInfoRequest $request
     * @return \Modules\Comic\Entities\Comic|null
     */
    public function edit(ComicInfoRequest $request)
    {
        return app(ManageComicService::class)->info($request->getId());
    }

    /**
     * @param ComicEditRequest $request
     * @return \Modules\Comic\Entities\Comic
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(ComicEditRequest $request)
    {
        return app(ManageComicService::class)->store($request, app(Cloud::class));
    }

    /**
     * @param ComicUpdateRequest $request
     * @return \Modules\Comic\Entities\Comic
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(ComicUpdateRequest $request)
    {
        return app(ManageComicService::class)->update($request, app(Cloud::class));
    }

    /**
     * @param ComicInfoRequest $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(ComicInfoRequest $request)
    {
        return app(ManageComicService::class)->delete($request, app(Cloud::class));
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

    /**
     * @param ComicEpisodeListRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Comic\Entities\ComicEpisode[]
     */
    public function episodeList(ComicEpisodeListRequest $request)
    {
        return app(ManageComicEpisodeService::class)->list($request);
    }

    /**
     * @param ComicEpisodeListRequest $request
     * @return int
     */
    public function episodeTotal(ComicEpisodeListRequest $request)
    {
        return app(ManageComicEpisodeService::class)->total($request);
    }

    /**
     * @param ComicEpisodeInfoRequest $request
     * @return \Modules\Comic\Entities\ComicEpisode|null
     */
    public function episodeEdit(ComicEpisodeInfoRequest $request)
    {
        return app(ManageComicEpisodeService::class)->info($request->getId());
    }

    /**
     * @param ComicEpisodeEditRequest $request
     * @return \Modules\Comic\Entities\ComicEpisode
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function episodeCreate(ComicEpisodeEditRequest $request)
    {
        return app(ManageComicEpisodeService::class)->create($request);
    }

    /**
     * @param ComicEpisodeUpdateRequest $request
     * @return \Modules\Comic\Entities\ComicEpisode
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function episodeUpdate(ComicEpisodeUpdateRequest $request)
    {
        return app(ManageComicEpisodeService::class)->update($request);
    }

    /**
     * @param ComicEpisodeInfoRequest $request
     * @return \Modules\Comic\Entities\ComicEpisode
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function episodeDelete(ComicEpisodeInfoRequest $request)
    {
        return app(ManageComicEpisodeService::class)->del($request->getId(), app(Cloud::class));
    }

    /**
     * @param UploadImageRequestHandle $request
     * @return \Modules\Comic\Entities\ComicGallery|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function uploadEpisodeImage(UploadImageRequestHandle $request)
    {
        return app(ManageComicEpisodeService::class)->uploadImage($request->getImage(), app(Cloud::class));
    }

    /**
     * @param RemoveImageRequestHandle $request
     * @return \Modules\Comic\Entities\ComicGallery|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function removeEpisodeImage(RemoveImageRequestHandle $request)
    {
        return app(ManageComicEpisodeService::class)->removeImage($request->getImageId(), app(Cloud::class));
    }
}
