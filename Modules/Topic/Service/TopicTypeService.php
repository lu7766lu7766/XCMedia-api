<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/6
 * Time: 上午 10:09
 */

namespace Modules\Topic\Service;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Topic\Entities\Topic;
use Modules\Topic\Http\Requests\GetIdRequestHandle;
use Modules\Topic\Http\Requests\ListRequestHandle;
use Modules\Topic\Http\Requests\StoreRequestHandle;
use Modules\Topic\Http\Requests\UpdateRequestHandle;
use Modules\Topic\Repositories\TopicTypeRepo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TopicTypeService
{
    /** @var Cloud $storage */
    private $storage;
    /** @var TopicTypeRepo */
    private $repo;
    /** @var string $type */
    private $type;

    /**
     * TopicSettingService constructor.
     * @param string $type
     * @param Cloud $storage
     */
    public function __construct(string $type, Cloud $storage)
    {
        $this->repo = new TopicTypeRepo();
        $this->type = $type;
        $this->storage = $storage;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|Topic[]
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
     * @return Topic|null
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
     * @return Topic
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
     * @return Topic|null
     * @throws ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        $topic = $this->repo->find($request->getId(), $this->type);
        if (is_null($topic)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        if ($request->getRemoveImage()) {
            $this->storage->delete($topic->image_path);
            $topic->image_path = null;
            $topic->image_url = null;
        }
        if (!is_null($request->getImage())) {
            $this->storage->delete($topic->image_path);
            $topic->image_path = $this->uploadImage($request->getImage());
            $topic->image_url = $this->storage->url($topic->image_path);
        }
        $attributes = [
            'title'      => $request->getTitle(),
            'status'     => $request->getStatus(),
            'remark'     => $request->getRemark(),
            'image_path' => $topic->image_path,
            'image_url'  => $topic->image_url
        ];

        return $this->repo->update($topic, $attributes);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return int
     * @throws ApiErrorCodeException
     */
    public function delete(GetIdRequestHandle $request)
    {
        $result = false;
        $topic = $this->repo->find($request->getId(), $this->type);
        if (is_null($topic)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        try {
            if (!is_null($topic->image_path)) {
                $this->storage->delete($topic->image_path);
            }
            $result = $topic->delete();
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
        $path = config('topic.file_path');

        return $this->storage->put($path, $image, Filesystem::VISIBILITY_PUBLIC);
    }
}

