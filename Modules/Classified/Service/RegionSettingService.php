<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/1/30
 * Time: 下午 03:49
 */

namespace Modules\Classified\Service;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Entities\Region;
use Modules\Classified\Http\Requests\Region\RegionIndexRequest;
use Modules\Classified\Http\Requests\Region\RegionInfoRequest;
use Modules\Classified\Http\Requests\Region\RegionStoreRequest;
use Modules\Classified\Http\Requests\Region\RegionTotalRequest;
use Modules\Classified\Http\Requests\Region\RegionUpdateRequest;
use Modules\Classified\Repositories\RegionRepo;

class RegionSettingService
{
    /** @var RegionRepo $repo */
    private $repo;
    /** @var string $usedType */
    private $usedType;

    /**
     * RegionSettingService constructor.
     * @param RegionRepo $repo
     * @param string $usedType
     */
    public function __construct(RegionRepo $repo, string $usedType)
    {
        $this->repo = $repo;
        $this->usedType = $usedType;
    }

    /**
     * @param RegionIndexRequest $request
     * @return Collection|Region[]
     */
    public function list(RegionIndexRequest $request)
    {
        return $this->repo->book(
            $this->usedType,
            $request->getName(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param RegionTotalRequest $request
     * @return int
     */
    public function total(RegionTotalRequest $request)
    {
        return $this->repo->count($this->usedType, $request->getName(), $request->getStatus());
    }

    /**
     * @param RegionInfoRequest $request
     * @return Region
     * @throws ApiErrorCodeException
     */
    public function info(RegionInfoRequest $request)
    {
        $region = $this->repo->findByType($request->getId(), $this->usedType);
        if (is_null($region)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'REGION NOT　FOUND');
        }

        return $region;
    }

    /**
     * @param RegionStoreRequest $request
     * @return Region
     * @throws ApiErrorCodeException
     */
    public function create(RegionStoreRequest $request)
    {
        $region = $this->repo->create(
            [
                'name'      => $request->getName(),
                'status'    => $request->getStatus(),
                'note'      => $request->getNote(),
                'used_type' => $this->usedType,
            ]
        );
        if (is_null($region)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'CREATE REGION FAIL');
        }

        return $region;
    }

    /**
     * @param RegionUpdateRequest $request
     * @return Region
     * @throws ApiErrorCodeException
     */
    public function update(RegionUpdateRequest $request)
    {
        $region = $this->repo->findByType($request->getId(), $this->usedType);
        if (is_null($region)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'REGION NOT　FOUND');
        }
        try {
            $region->update([
                'name'   => $request->getName(),
                'status' => $request->getStatus(),
                'note'   => $request->getNote()
            ]);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw  new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'UPDATE REGION FAIL');
        }

        return $region;
    }

    /**
     * @param RegionInfoRequest $request
     * @return Region
     * @throws ApiErrorCodeException
     */
    public function delete(RegionInfoRequest $request)
    {
        $region = $this->repo->findByType($request->getId(), $this->usedType);
        if (is_null($region)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'REGION NOT　FOUND');
        }
        if ($region->delete() == 0) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'UPDATE REGION FAIL');
        }

        return $region;
    }
}
