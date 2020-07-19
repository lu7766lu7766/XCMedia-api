<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 07:00
 */

namespace Modules\Photograph\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Photograph\Entities\PhotographPhoto;
use Modules\Photograph\Http\Requests\PhotographyPhoto\IndexRequest;
use Modules\Photograph\Http\Requests\PhotographyPhoto\InfoRequest;
use Modules\Photograph\Http\Requests\PhotographyPhoto\UploadRequest;
use Modules\Photograph\Repositories\PhotographAlbumRepo;
use Modules\Photograph\Repositories\PhotographyPhotoRepo;

class PhotographyPhotoManageService
{
    /** @var PhotographyPhotoRepo $repo */
    private $repo;

    /**
     * PhotographyPhotoManageService constructor.
     * @param PhotographyPhotoRepo $repo
     */
    public function __construct(PhotographyPhotoRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param IndexRequest $request
     * @return Collection|PhotographPhoto[]
     */
    public function list(IndexRequest $request): Collection
    {
        return $this->repo->getByPhotography($request->getPhotographId());
    }

    /**
     * @param UploadRequest $request
     * @param Cloud $cloud
     * @param PhotographAlbumRepo $repo
     * @return PhotographPhoto
     * @throws ApiErrorCodeException
     */
    public function upload(UploadRequest $request, Cloud $cloud, PhotographAlbumRepo $repo)
    {
        $album = $repo->find($request->getPhotographId());
        if (is_null($album)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'PHOTOGRAPH ALBUM NOT FOUND');
        }
        /** @var false|string $path */
        $path = $cloud->put(
            config('Photograph.config.photo_file_path'),
            $request->getFile(),
            $cloud::VISIBILITY_PUBLIC
        );
        if (is_bool($path)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'UPLOAD PHOTO FILE FAIL');
        }
        $attribute = [
            'name'      => $request->getFile()->getClientOriginalName(),
            'file_path' => $path,
            'file_url'  => $cloud->url($path),
        ];
        $photo = new PhotographPhoto($attribute);
        try {
            $photo->album()->associate($album);
            $photo->save();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'CREATE PHOTO FAIL');
        }

        return $photo;
    }

    /**
     * @param InfoRequest $request
     * @param Cloud $cloud
     * @return PhotographPhoto
     * @throws ApiErrorCodeException
     */
    public function delete(InfoRequest $request, Cloud $cloud): PhotographPhoto
    {
        $photo = $this->repo->find($request->getId());
        if (is_null($photo)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'PHOTO NOT FOUND');
        }
        $cloud->delete($photo->file_path);
        $photo->delete();

        return $photo;
    }
}
