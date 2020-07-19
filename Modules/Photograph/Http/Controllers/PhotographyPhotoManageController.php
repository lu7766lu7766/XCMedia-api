<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 06:57
 */

namespace Modules\Photograph\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Modules\Photograph\Entities\PhotographPhoto;
use Modules\Photograph\Http\Requests\PhotographyPhoto\IndexRequest;
use Modules\Photograph\Http\Requests\PhotographyPhoto\InfoRequest;
use Modules\Photograph\Http\Requests\PhotographyPhoto\UploadRequest;
use Modules\Photograph\Repositories\PhotographAlbumRepo;
use Modules\Photograph\Services\PhotographyPhotoManageService;

class PhotographyPhotoManageController extends Controller
{
    /** @var PhotographyPhotoManageService $service */
    private $service;

    /**
     * PhotographyPhotoManageController constructor.
     * @param PhotographyPhotoManageService $service
     */
    public function __construct(PhotographyPhotoManageService $service)
    {
        $this->service = $service;
    }

    /**
     * @param IndexRequest $request
     * @return Collection|PhotographPhoto[]
     */
    public function index(IndexRequest $request): Collection
    {
        return $this->service->list($request);
    }

    /**
     * @param UploadRequest $request
     * @param Cloud $cloud
     * @param PhotographAlbumRepo $repo
     * @return \Modules\Photograph\Entities\PhotographPhoto
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function upload(UploadRequest $request, Cloud $cloud, PhotographAlbumRepo $repo): PhotographPhoto
    {
        return $this->service->upload($request, $cloud, $repo);
    }

    /**
     * @param InfoRequest $request
     * @param Cloud $cloud
     * @return \Modules\Photograph\Entities\PhotographPhoto
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(InfoRequest $request, Cloud $cloud): PhotographPhoto
    {
        return $this->service->delete($request, $cloud);
    }
}
