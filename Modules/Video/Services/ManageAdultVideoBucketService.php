<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 03:25
 */

namespace Modules\Video\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Video\Entities\AdultVideoBucket;
use Modules\Video\Http\Requests\Manage\AdultVideoBucketInfoRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoBucketStoreRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoBucketUpdateRequest;
use Modules\Video\Repositories\AdultVideoBucketRepo;
use Modules\Video\Repositories\AdultVideoRepo;

class ManageAdultVideoBucketService
{
    /** @var AdultVideoBucketRepo $repo */
    private $repo;

    /**
     * ManageAdultVideoBucketService constructor.
     * @param AdultVideoBucketRepo $repo
     */
    public function __construct(AdultVideoBucketRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param AdultVideoBucketInfoRequest $request
     * @return AdultVideoBucket
     * @throws ApiErrorCodeException
     */
    public function info(AdultVideoBucketInfoRequest $request): AdultVideoBucket
    {
        $bucket = $this->repo->find($request->getId());
        if (is_null($bucket)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ADULT VIDEO BUCKET MODEL NOT FOUND');
        }

        return $bucket;
    }

    /**
     * @param AdultVideoBucketStoreRequest $request
     * @param Cloud $cloud
     * @param AdultVideoRepo $repo
     * @return AdultVideoBucket
     * @throws ApiErrorCodeException
     */
    public function create(AdultVideoBucketStoreRequest $request, Cloud $cloud, AdultVideoRepo $repo): AdultVideoBucket
    {
        $adultVideo = $repo->find($request->getAdultVideoId());
        if (is_null($adultVideo)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ADULT VIDEO MODEL NOT FOUND');
        }
        $attribute = [
            'release_time' => $request->getReleaseTime(),
            'status'       => $request->getStatus(),
        ];
        if (!is_null($video = $request->getVideo())) {
            $uploadPath = $this->upload($cloud, $video, config('Video.config.adult_video_path'));
            $attribute['file_path'] = $uploadPath;
            $attribute['file_url'] = $cloud->url($uploadPath);
        }
        try {
            $bucket = $this->repo->create($attribute, $adultVideo);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'CREATE ADULT VIDEO BUCKET FAIL');
        }

        return $bucket;
    }

    /**
     * @param AdultVideoBucketUpdateRequest $request
     * @param Cloud $cloud
     * @return AdultVideoBucket
     * @throws ApiErrorCodeException
     */
    public function update(AdultVideoBucketUpdateRequest $request, Cloud $cloud): AdultVideoBucket
    {
        $bucket = $this->repo->find($request->getId());
        if (is_null($bucket)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ADULT VIDEO BUCKET MODEL NOT FOUND');
        }
        $attribute = [
            'release_time' => $request->getReleaseTime(),
            'status'       => $request->getStatus(),
        ];
        if ($request->getRemoveVideo()) {
            $cloud->delete($bucket->file_path);
            $bucket->file_path = null;
            $bucket->file_url = null;
        }
        if (!is_null($video = $request->getVideo())) {
            $uploadPath = $this->upload($cloud, $video, config('Video.config.adult_video_path'));
            $attribute['file_path'] = $uploadPath;
            $attribute['file_url'] = $cloud->url($uploadPath);
            if (!is_null($path = $bucket->file_path)) {
                $cloud->delete($path);
            }
        }
        try {
            $bucket->update($attribute);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw  new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'UPDATE ADULT VIDEO BUCKET FAIL');
        }

        return $bucket;
    }

    /**
     * @param Cloud $cloud
     * @param UploadedFile $file
     * @param string $path
     * @return string
     * @throws ApiErrorCodeException
     */
    private function upload(Cloud $cloud, UploadedFile $file, string $path): string
    {
        /** @var false|string $path */
        $path = $cloud->put($path, $file, $cloud::VISIBILITY_PUBLIC);
        if (is_bool($path)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'UPLOAD FILE FAIL');
        }

        return $path;
    }
}
