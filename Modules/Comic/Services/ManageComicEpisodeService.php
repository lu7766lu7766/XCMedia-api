<?php

namespace Modules\Comic\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Comic\Entities\ComicEpisode;
use Modules\Comic\Entities\ComicGallery;
use Modules\Comic\Http\Requests\Manage\ComicEpisodeEditRequest;
use Modules\Comic\Http\Requests\Manage\ComicEpisodeListRequest;
use Modules\Comic\Http\Requests\Manage\ComicEpisodeUpdateRequest;
use Modules\Comic\Repositories\ComicEpisodeRepo;
use Modules\Comic\Repositories\ComicGalleryRepo;
use Modules\Comic\Repositories\ComicRepo;
use XC\Independent\Kit\Support\Scalar\ArrayMaster;

class ManageComicEpisodeService
{
    /**
     * @param ComicEpisodeListRequest $request
     * @return Collection|ComicEpisode[]
     */
    public function list(ComicEpisodeListRequest $request)
    {
        return app(ComicEpisodeRepo::class)->list(
            $request->getComicId(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param ComicEpisodeListRequest $request
     * @return int
     */
    public function total(ComicEpisodeListRequest $request)
    {
        return app(ComicEpisodeRepo::class)->total($request->getComicId());
    }

    /**
     * @param int $id
     * @return ComicEpisode|null
     */
    public function info(int $id)
    {
        $result = app(ComicEpisodeRepo::class)->findById($id);

        return is_null($result) ? $result : $result->load('gallery');
    }

    /**
     * @param ComicEpisodeEditRequest $request
     * @return ComicEpisode
     * @throws ApiErrorCodeException
     */
    public function create(ComicEpisodeEditRequest $request)
    {
        $comic = app(ComicRepo::class)->findById($request->getComicId());
        if (is_null($comic)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Comic not found');
        }
        $attributes = [
            'title'        => $request->getTitle(),
            'opening_time' => $request->getOpeningTime(),
            'status'       => $request->getStatus()
        ];
        $episode = new ComicEpisode($attributes);
        try {
            \DB::transaction(function () use ($comic, $request, $episode) {
                $episode->comic()->associate($comic)->save();
                $episode->gallery()->sync($request->getImageIds());
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL);
        }

        return $episode->load('gallery');
    }

    /**
     * @param ComicEpisodeUpdateRequest $request
     * @return ComicEpisode
     * @throws ApiErrorCodeException
     */
    public function update(ComicEpisodeUpdateRequest $request)
    {
        $comicEpisode = $this->getComicEpisode($request->getId());
        $attributes = [
            'title'        => $request->getTitle(),
            'opening_time' => $request->getOpeningTime(),
            'status'       => $request->getStatus()
        ];
        $comicEpisode->fill($attributes);
        try {
            \DB::transaction(function () use ($request, $comicEpisode, &$result) {
                $comicEpisode->save();
                if (ArrayMaster::isList($request->getImageIds())) {
                    $comicEpisode->gallery()->sync($request->getImageIds());
                }
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $comicEpisode->load('gallery');
    }

    /**
     * @param int $id
     * @param Cloud $cloud
     * @return ComicEpisode
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function del(int $id, Cloud $cloud)
    {
        $comicEpisode = $this->getComicEpisode($id);
        $gallery = $comicEpisode->gallery;
        try {
            \DB::transaction(function () use ($comicEpisode, $gallery, $cloud) {
                $comicEpisode->delete();
                $gallery->each(function (ComicGallery $image) use ($cloud) {
                    $image->delete();
                    $cloud->delete($image->file_path);
                });
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $comicEpisode;
    }

    /**
     * @param UploadedFile $image
     * @param Cloud $cloud
     * @return ComicGallery|null
     * @throws ApiErrorCodeException
     */
    public function uploadImage(UploadedFile $image, Cloud $cloud)
    {
        $path = $cloud->put(config('Comic.config.comic_path'), $image, $cloud::VISIBILITY_PUBLIC);
        if (is_bool($path)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'Upload image fail');
        }
        $url = $cloud->url($path);
        $attributes = [
            'name'      => $image->getClientOriginalName(),
            'file_path' => $path,
            'file_url'  => $url
        ];

        return app(ComicGalleryRepo::class)->create($attributes);
    }

    /**
     * @param int $id
     * @param Cloud $cloud
     * @return ComicGallery
     * @throws ApiErrorCodeException
     */
    public function removeImage(int $id, Cloud $cloud)
    {
        $image = app(ComicGalleryRepo::class)->findById($id);
        if (is_null($image)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        try {
            \DB::transaction(function () use ($id, $cloud, $image) {
                $image->delete();
                $cloud->delete($image->file_path);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $image;
    }

    /**
     * @param int $id
     * @return ComicEpisode
     * @throws ApiErrorCodeException
     */
    private function getComicEpisode(int $id)
    {
        if (is_null($comicEpisode = $this->info($id))) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        };

        return $comicEpisode;
    }
}
