<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 上午 11:24
 */

namespace Modules\Classified\Service;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\ApiCode\OOOO3AVActressCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Entities\AVActress;
use Modules\Classified\Http\Requests\AVActress\AVActressIndexRequest;
use Modules\Classified\Http\Requests\AVActress\AVActressInfoRequest;
use Modules\Classified\Http\Requests\AVActress\AVActressStoreRequest;
use Modules\Classified\Http\Requests\AVActress\AVActressTotalRequest;
use Modules\Classified\Http\Requests\AVActress\AVActressUpdateRequest;
use Modules\Classified\Repositories\AVActressRepo;

class MediaActressService
{
    /** @var string $useType */
    private $useType;
    /** @var AVActressRepo $repo */
    private $repo;

    /**
     * MediaActressService constructor.
     * @param string $useType
     * @param AVActressRepo $repo
     */
    public function __construct(string $useType, AVActressRepo $repo)
    {
        $this->useType = $useType;
        $this->repo = $repo;
    }

    /**
     * @param AVActressIndexRequest $request
     * @return Collection|AVActress[]
     */
    public function list(AVActressIndexRequest $request)
    {
        return $this->repo->book(
            $this->useType,
            $request->getKeyword(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param AVActressTotalRequest $request
     * @return int
     */
    public function total(AVActressTotalRequest $request)
    {
        return $this->repo->count(
            $this->useType,
            $request->getKeyword(),
            $request->getStatus()
        );
    }

    /**
     * @param AVActressStoreRequest $request
     * @param Cloud $cloud
     * @return AVActress
     * @throws ApiErrorCodeException
     */
    public function create(AVActressStoreRequest $request, Cloud $cloud)
    {
        $params = [
            'name'      => $request->getName(),
            'alias'     => $request->getAlias(),
            'status'    => $request->getStatus(),
            'note'      => $request->getNote(),
            'used_type' => $this->useType
        ];
        $cover = $request->getCover();
        if (!is_null($cover)) {
            $path = $this->uploadCover($cover, $cloud);
            $params['image_path'] = $path;
            $params['image_url'] = $cloud->url($path);
        }
        $actress = $this->repo->create($params);
        if (is_null($actress)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'CREATE AV ACTRESS FAIL');
        }

        return $actress;
    }

    /**
     * @param AVActressUpdateRequest $request
     * @param Cloud $cloud
     * @return AVActress
     * @throws ApiErrorCodeException
     */
    public function update(AVActressUpdateRequest $request, Cloud $cloud)
    {
        $actress = $this->repo->findByUsedType($request->getId(), $this->useType);
        if (is_null($actress)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ACTRESS NOT　FOUND');
        }
        $params = [
            'name'      => $request->getName(),
            'alias'     => $request->getAlias(),
            'status'    => $request->getStatus(),
            'note'      => $request->getNote(),
            'used_type' => $this->useType
        ];
        $cover = $request->getCover();
        if ($request->getRemoveCover()) {
            $cloud->delete($actress->image_path);
            $actress->image_path = null;
            $actress->image_url = null;
        }
        if (!is_null($cover)) {
            $cloud->delete($actress->image_path);
            $path = $this->uploadCover($cover, $cloud);
            $params['image_path'] = $path;
            $params['image_url'] = $cloud->url($path);
        }
        $actress->update($params);

        return $actress;
    }

    /**
     * @param UploadedFile $cover
     * @param Cloud $cloud
     * @return string
     * @throws ApiErrorCodeException
     */
    private function uploadCover(UploadedFile $cover, Cloud $cloud)
    {
        $fullPath = $cloud->put(
            config('Classified.config.av_actress_path'),
            $cover,
            ['visibility' => Filesystem::VISIBILITY_PUBLIC]
        );
        if (is_bool($fullPath)) {
            throw new ApiErrorCodeException(OOOO3AVActressCodes::UPLOAD_IMAGE_FAIL, 'UPLOAD IMAGE FAIL');
        }

        return $fullPath;
    }

    /**
     * @param AVActressInfoRequest $request
     * @return AVActress
     * @throws ApiErrorCodeException
     */
    public function info(AVActressInfoRequest $request)
    {
        $actress = $this->repo->findByUsedType($request->getId(), $this->useType);
        if (is_null($actress)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ACTRESS NOT　FOUND');
        }

        return $actress;
    }

    /**
     * @param AVActressInfoRequest $request
     * @param Cloud $cloud
     * @return AVActress
     * @throws ApiErrorCodeException
     */
    public function delete(AVActressInfoRequest $request, Cloud $cloud)
    {
        $actress = $this->info($request);
        try {
            if (!is_null($path = $actress->image_path)) {
                $cloud->delete($path);
            }
            $actress->delete();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw  new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'DELETE ACTRESS FAIL');
        }

        return $actress;
    }
}
