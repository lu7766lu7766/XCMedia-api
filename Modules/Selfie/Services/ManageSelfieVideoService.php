<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 12:19
 */

namespace Modules\Selfie\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Selfie\Entities\SelfieVideo;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\IndexRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\InfoRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\StoreRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\TotalRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieVideo\UpdateRequest;
use Modules\Selfie\Repositories\SelfieScheduleRepo;
use Modules\Selfie\Repositories\SelfieVideoRepo;

class ManageSelfieVideoService
{
    /** @var SelfieVideoRepo $repo */
    private $repo;

    /**
     * ManageSelfieVideoService constructor.
     * @param SelfieVideoRepo $repo
     */
    public function __construct(SelfieVideoRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param IndexRequest $request
     * @return Collection|SelfieVideo[]
     */
    public function list(IndexRequest $request)
    {
        return $this->repo->book($request->getScheduleId(), $request->getPage(), $request->getPerpage());
    }

    /**
     * @param TotalRequest $request
     * @return int
     */
    public function total(TotalRequest $request)
    {
        return $this->repo->count($request->getScheduleId());
    }

    /**
     * @param InfoRequest $request
     * @return SelfieVideo
     * @throws ApiErrorCodeException
     */
    public function info(InfoRequest $request)
    {
        $video = $this->repo->find($request->getId());
        if (is_null($video)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }

        return $video;
    }

    /**
     * @param StoreRequest $request
     * @param Cloud $cloud
     * @param SelfieScheduleRepo $repo
     * @return SelfieVideo
     * @throws ApiErrorCodeException
     */
    public function create(StoreRequest $request, Cloud $cloud, SelfieScheduleRepo $repo)
    {
        $schedule = $repo->find($request->getScheduleId());
        if (is_null($schedule)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'SCHEDULE MODEL NOT FOUND');
        }
        $attribute = [
            'title'        => $request->getTitle(),
            'release_date' => $request->getReleaseData(),
            'status'       => $request->getStatus(),
        ];
        if (!is_null($cover = $request->getCover())) {
            $coverPath = $this->upload(config('Selfie.config.video_cover_path'), $cover, $cloud);
            $attribute['cover_path'] = $coverPath;
            $attribute['cover_url'] = $cloud->url($coverPath);
        }
        if (!is_null($video = $request->getVideo())) {
            $videoPath = $this->upload(config('Selfie.config.video_path'), $video, $cloud);
            $attribute['video_path'] = $videoPath;
            $attribute['video_url'] = $cloud->url($videoPath);
        }
        try {
            $selfieVideo = new SelfieVideo($attribute);
            \DB::transaction(function () use ($selfieVideo, $schedule) {
                $selfieVideo->schedule()->associate($schedule);
                $selfieVideo->save();
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'CREATE VIDEO FAIL');
        }

        return $selfieVideo;
    }

    /**
     * @param string $path
     * @param UploadedFile $file
     * @param Cloud $cloud
     * @return string
     * @throws ApiErrorCodeException
     */
    private function upload(string $path, UploadedFile $file, Cloud $cloud)
    {
        /** @var string|false $path */
        $path = $cloud->put($path, $file, $cloud::VISIBILITY_PUBLIC);
        if (is_bool($path)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'UPLOAD FILE FAIL');
        }

        return $path;
    }

    /**
     * @param UpdateRequest $request
     * @param Cloud $cloud
     * @return SelfieVideo
     * @throws ApiErrorCodeException
     */
    public function update(UpdateRequest $request, Cloud $cloud)
    {
        $selfieVideo = $this->repo->find($request->getId());
        if (is_null($selfieVideo)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'VIDEO MODEL NOT FOUND');
        }
        $attribute = [
            'title'        => $request->getTitle(),
            'release_date' => $request->getReleaseData(),
            'status'       => $request->getStatus(),
        ];
        if ($request->getRemoveCover()) {
            $cloud->delete($selfieVideo->cover_path);
            $selfieVideo->cover_path = null;
            $selfieVideo->cover_url = null;
        }
        if (!is_null($video = $request->getVideo())) {
            $cloud->delete($selfieVideo->video_path);
            $selfieVideo->video_path = null;
            $selfieVideo->video_url = null;
        }
        if (!is_null($cover = $request->getCover())) {
            $coverPath = $this->upload(config('Selfie.config.video_cover_path'), $cover, $cloud);
            $attribute['cover_path'] = $coverPath;
            $attribute['cover_url'] = $cloud->url($coverPath);
            if (!is_null($path = $selfieVideo->cover_path)) {
                $cloud->delete($path);
            }
        }
        if (!is_null($video = $request->getVideo())) {
            $videoPath = $this->upload(config('Selfie.config.video_path'), $video, $cloud);
            $attribute['video_path'] = $videoPath;
            $attribute['video_url'] = $cloud->url($videoPath);
            if (!is_null($path = $selfieVideo->video_path)) {
                $cloud->delete($path);
            }
        }
        try {
            $selfieVideo->update($attribute);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'UPDATE VIDEO FAIL');
        }

        return $selfieVideo;
    }

    /**
     * @param InfoRequest $request
     * @param Cloud $cloud
     * @return SelfieVideo
     * @throws ApiErrorCodeException
     */
    public function delete(InfoRequest $request, Cloud $cloud)
    {
        $selfieVideo = $this->repo->find($request->getId());
        if (is_null($selfieVideo)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'VIDEO MODEL NOT FOUND');
        }
        if (!is_null($path = $selfieVideo->cover_path)) {
            $cloud->delete($path);
        }
        if (!is_null($path = $selfieVideo->video_path)) {
            $cloud->delete($path);
        }
        try {
            $selfieVideo->delete();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw  new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'UPDATE VIDEO FAIL');
        }

        return $selfieVideo;
    }
}
