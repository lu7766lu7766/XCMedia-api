<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/8
 * Time: 下午 07:46
 */

namespace Modules\Advertisement\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Modules\Advertisement\Entities\Advertisement;
use Modules\Advertisement\Http\Requests\DeleteRequestHandle;
use Modules\Advertisement\Http\Requests\EditRequestHandle;
use Modules\Advertisement\Http\Requests\ListRequestHandle;
use Modules\Advertisement\Http\Requests\StoreRequestHandle;
use Modules\Advertisement\Http\Requests\UpdateRequestHandle;
use Modules\Advertisement\Repositories\AdvertisementRepo;
use Modules\Advertisement\Repositories\AdvertisementTypeRepo;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Branch\Contracts\IBranchProvider;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ManageAdvertisementService
{
    /** @var Cloud $storage */
    private $storage;
    /** @var AdvertisementTypeRepo $typeRepo */
    private $typeRepo;
    /** @var AdvertisementRepo $repo */
    private $repo;
    /** @var IBranchProvider $branchProvider */
    private $branchProvider;

    /**
     * ManageAdvertisementService constructor.
     * @param Cloud $storage
     * @param IBranchProvider $branchProvider
     */
    public function __construct(Cloud $storage, IBranchProvider $branchProvider)
    {
        $this->storage = $storage;
        $this->typeRepo = new AdvertisementTypeRepo();
        $this->repo = new AdvertisementRepo();
        $this->branchProvider = $branchProvider;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|Advertisement[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $request->getTypeId(),
            $request->getStatus(),
            $request->getTitle(),
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
        return $this->repo->count(
            $request->getTypeId(),
            $request->getStatus(),
            $request->getTitle()
        );
    }

    /**
     * @param StoreRequestHandle $request
     * @return Advertisement|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function create(StoreRequestHandle $request)
    {
        $type = $this->typeRepo->find($request->getTypeId());
        $branches = $this->branchProvider->getByIds($request->getBranches());
        if (is_null($type) || $branches->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $imagePath = $this->uploadImage($request->getImage());
        $attributes = [
            'title'      => $request->getTitle(),
            'url'        => $request->getUrl(),
            'is_blank'   => $request->getIsBlank(),
            'status'     => $request->getStatus(),
            'image_path' => $imagePath,
            'image_url'  => $this->storage->url($imagePath),
        ];
        $result = $this->repo->create($type, $attributes, $branches);

        return $result ? $result->load(['type', 'branches']) : null;
    }

    /**
     * @param EditRequestHandle $request
     * @return Advertisement|null
     * @throws ApiErrorCodeException
     */
    public function edit(EditRequestHandle $request)
    {
        $result = $this->repo->find($request->getId());
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }

        return $result->load(['type', 'branches']);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        $result = null;
        $advertisement = $this->repo->find($request->getId());
        $type = $this->typeRepo->find($request->getTypeId());
        $branches = $this->branchProvider->getByIds($request->getBranches());
        if (is_null($advertisement) || is_null($type) || $branches->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'title'    => $request->getTitle(),
            'url'      => $request->getUrl(),
            'is_blank' => $request->getIsBlank(),
            'status'   => $request->getStatus()
        ];
        if (!is_null($request->getImage())) {
            $this->storage->delete($advertisement->image_path);
            $imagePath = $this->uploadImage($request->getImage());
            $attributes['image_path'] = $imagePath;
            $attributes['image_url'] = $this->storage->url($imagePath);
        }
        $result = $this->repo->update($type, $advertisement, $attributes, $branches);

        return $result ? $result->load(['type', 'branches']) : null;
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request)
    {
        $advertisement = $this->repo->find($request->getId());
        if (is_null($advertisement)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        if ($result = $this->repo->delete($advertisement)) {
            $this->storage->delete($advertisement->image_path);
        }

        return $result;
    }

    /**
     * @param UploadedFile $image
     * @return string
     */
    private function uploadImage(UploadedFile $image)
    {
        $path = config('advertisement.file_path');

        return $this->storage->put($path, $image, Filesystem::VISIBILITY_PUBLIC);
    }
}
