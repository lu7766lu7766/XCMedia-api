<?php

namespace Modules\Literature\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Routing\Controller;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;
use Modules\Literature\Http\Requests\VolumeAddRequestHandle;
use Modules\Literature\Http\Requests\VolumeCountRequestHandle;
use Modules\Literature\Http\Requests\VolumeDeleteRequestHandle;
use Modules\Literature\Http\Requests\VolumeListRequestHandle;
use Modules\Literature\Http\Requests\VolumeUpdateRequestHandle;
use Modules\Literature\Services\LiteratureVolumeService;

class ManageLiteratureVolumeController extends Controller
{
    /**
     * @param VolumeListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Literature\Entities\LiteratureVolume[]
     */
    public function list(VolumeListRequestHandle $request)
    {
        return app(LiteratureVolumeService::class)->list($request);
    }

    /**
     * @param VolumeAddRequestHandle $request
     * @return \Modules\Literature\Entities\LiteratureVolume
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function add(VolumeAddRequestHandle $request)
    {
        return app(LiteratureVolumeService::class)->add($request);
    }

    /**
     * @param VolumeUpdateRequestHandle $request
     * @return \Modules\Literature\Entities\LiteratureVolume
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(VolumeUpdateRequestHandle $request)
    {
        return app(LiteratureVolumeService::class)->update($request);
    }

    /**
     * @param VolumeDeleteRequestHandle $request
     * @param Cloud $cloud
     * @return bool
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(VolumeDeleteRequestHandle $request, Cloud $cloud)
    {
        return app(LiteratureVolumeService::class)->delete($request, $cloud);
    }

    /**
     * @param VolumeCountRequestHandle $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function count(VolumeCountRequestHandle $request)
    {
        return app(LiteratureVolumeService::class)->count($request);
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
}
