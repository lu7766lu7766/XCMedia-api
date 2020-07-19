<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/1/30
 * Time: 下午 03:01
 */

namespace Modules\Classified\Service;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Entities\Genres;
use Modules\Classified\Http\Requests\Genres\GetIdRequestHandle;
use Modules\Classified\Http\Requests\Genres\ListRequestHandle;
use Modules\Classified\Http\Requests\Genres\StoreRequestHandle;
use Modules\Classified\Http\Requests\Genres\UpdateRequestHandle;
use Modules\Classified\Repositories\GenresSettingRepo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GenresSettingService
{
    /** @var Cloud $storage */
    private $storage;
    /** @var GenresSettingRepo */
    private $repo;
    /** @var string $type */
    private $type;

    /**
     * GenresSettingService constructor.
     * @param string $type
     * @param Cloud $storage
     */
    public function __construct(string $type, Cloud $storage)
    {
        $this->repo = new GenresSettingRepo();
        $this->type = $type;
        $this->storage = $storage;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|Genres[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $this->type,
            $request->getTitle(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return $this->repo->count($this->type, $request->getTitle(), $request->getStatus());
    }

    /**
     * @param StoreRequestHandle $request
     * @return Genres|null
     */
    public function create(StoreRequestHandle $request)
    {
        $imagePath = null;
        $imageUrl = null;
        if (!is_null($request->getImage())) {
            $imagePath = $this->uploadImage($request->getImage());
            $imageUrl = $this->storage->url($imagePath);
        }
        $attributes = [
            'title'      => $request->getTitle(),
            'status'     => $request->getStatus(),
            'remark'     => $request->getRemark(),
            'image_path' => $imagePath,
            'image_url'  => $imageUrl
        ];

        return $this->repo->create($attributes, $this->type);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Genres|null
     * @throws ApiErrorCodeException
     */
    public function edit(GetIdRequestHandle $request)
    {
        $result = $this->repo->find($request->getId(), $this->type);
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }

        return $result;
    }

    /**
     * @param UpdateRequestHandle $request
     * @return Genres|null
     * @throws ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        $genres = $this->repo->find($request->getId(), $this->type);
        if (is_null($genres)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        if ($request->getRemoveImage()) {
            $this->storage->delete($genres->image_path);
            $genres->image_path = null;
            $genres->image_url = null;
        }
        if (!is_null($request->getImage())) {
            $this->storage->delete($genres->image_path);
            $genres->image_path = $this->uploadImage($request->getImage());
            $genres->image_url = $this->storage->url($genres->image_path);
        }
        $attributes = [
            'title'      => $request->getTitle(),
            'status'     => $request->getStatus(),
            'remark'     => $request->getRemark(),
            'image_path' => $genres->image_path,
            'image_url'  => $genres->image_url
        ];

        return $this->repo->update($genres, $attributes);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return int
     * @throws ApiErrorCodeException
     */
    public function delete(GetIdRequestHandle $request)
    {
        $result = false;
        $genres = $this->repo->find($request->getId(), $this->type);
        if (is_null($genres)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        try {
            if (!is_null($genres->image_path)) {
                $this->storage->delete($genres->image_path);
            }
            $result = $genres->delete();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return (integer)$result;
    }

    /**
     * @param UploadedFile $image
     * @return bool
     */
    private function uploadImage(UploadedFile $image)
    {
        $path = config('classified.genres_file_path');

        return $this->storage->put($path, $image, Filesystem::VISIBILITY_PUBLIC);
    }
}
