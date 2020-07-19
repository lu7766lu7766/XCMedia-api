<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 上午 11:07
 */

namespace Modules\Classified\Service;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Entities\Cup;
use Modules\Classified\Http\Requests\Cup\CupIndexRequest;
use Modules\Classified\Http\Requests\Cup\CupInfoRequest;
use Modules\Classified\Http\Requests\Cup\CupStoreRequest;
use Modules\Classified\Http\Requests\Cup\CupTotalRequest;
use Modules\Classified\Http\Requests\Cup\CupUpdateRequest;
use Modules\Classified\Repositories\CupRepo;

class MediaCupService
{
    /** @var string $useType */
    private $useType;
    /** @var CupRepo $repo */
    private $repo;

    /**
     * CupService constructor.
     * @param CupRepo $repo
     * @param string $useType
     */
    public function __construct(CupRepo $repo, string $useType)
    {
        $this->useType = $useType;
        $this->repo = $repo;
    }

    /**
     * @param CupIndexRequest $request
     * @return Collection|Cup[]
     */
    public function list(CupIndexRequest $request)
    {
        return $this->repo->book(
            $this->useType,
            $request->getSize(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param CupTotalRequest $request
     * @return int
     */
    public function total(CupTotalRequest $request)
    {
        return $this->repo->total($this->useType, $request->getSize(), $request->getStatus());
    }

    /**
     * @param CupInfoRequest $request
     * @return Cup|null
     * @throws ApiErrorCodeException
     */
    public function info(CupInfoRequest $request)
    {
        $cup = $this->repo->findByUsedType($this->useType, $request->getId());
        if (is_null($cup)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }

        return $cup;
    }

    /**
     * @param CupStoreRequest $request
     * @return Cup
     * @throws ApiErrorCodeException
     */
    public function create(CupStoreRequest $request)
    {
        $params = [
            'size'      => $request->getSize(),
            'status'    => $request->getStatus(),
            'note'      => $request->getNote(),
            'used_type' => $this->useType,
        ];
        $cup = $this->repo->create($params);
        if (is_null($cup)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL);
        }

        return $cup;
    }

    /**
     * @param CupUpdateRequest $request
     * @return Cup
     * @throws ApiErrorCodeException
     */
    public function update(CupUpdateRequest $request)
    {
        $cup = $this->repo->findByUsedType($this->useType, $request->getId());
        if (is_null($cup)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        try {
            $cup->update([
                'size'   => $request->getSize(),
                'status' => $request->getStatus(),
                'note'   => $request->getNote(),
            ]);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $cup;
    }

    /**
     * @param CupInfoRequest $request
     * @return Cup
     * @throws ApiErrorCodeException
     */
    public function delete(CupInfoRequest $request)
    {
        $cup = $this->repo->findByUsedType($this->useType, $request->getId());
        if (is_null($cup)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        try {
            $cup->delete();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $cup;
    }
}
