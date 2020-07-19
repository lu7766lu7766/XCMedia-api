<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/20
 * Time: 下午 06:04
 */

namespace Modules\Classified\Service;

use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Entities\Source;
use Modules\Classified\Http\Requests\Source\GetIdRequestHandle;
use Modules\Classified\Http\Requests\Source\ListRequestHandle;
use Modules\Classified\Http\Requests\Source\StoreRequestHandle;
use Modules\Classified\Http\Requests\Source\UpdateRequestHandle;
use Modules\Classified\Repositories\SourceSettingRepo;

class SourceSettingService
{
    /** @var SourceSettingRepo $repo */
    private $repo;

    /**
     * SourceSettingService constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->repo = new SourceSettingRepo($type);
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|Source[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
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
        return $this->repo->count($request->getTitle(), $request->getStatus());
    }

    /**
     * @param StoreRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Model|null|Source
     */
    public function create(StoreRequestHandle $request)
    {
        $attributes = [
            'title'           => $request->getTitle(),
            'status'          => $request->getStatus(),
            'remark'          => $request->getRemark(),
            'analyze_address' => $request->getAnalyzeAddress()
        ];

        return $this->repo->create($attributes);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Model|null|Source
     * @throws ApiErrorCodeException
     */
    public function edit(GetIdRequestHandle $request)
    {
        $result = $this->repo->find($request->getId());
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }

        return $result;
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Model|null|Source
     * @throws ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        $source = $this->repo->find($request->getId());
        if (is_null($source)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'title'           => $request->getTitle(),
            'status'          => $request->getStatus(),
            'remark'          => $request->getRemark(),
            'analyze_address' => $request->getAnalyzeAddress()
        ];

        return $this->repo->update($source, $attributes);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return int
     */
    public function delete(GetIdRequestHandle $request)
    {
        return $this->repo->delete($request->getId());
    }
}
