<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/3
 * Time: 下午 07:23
 */

namespace Modules\Classified\Service;

use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Entities\Language;
use Modules\Classified\Http\Requests\Language\GetIdRequestHandle;
use Modules\Classified\Http\Requests\Language\ListRequestHandle;
use Modules\Classified\Http\Requests\Language\StoreRequestHandle;
use Modules\Classified\Http\Requests\Language\UpdateRequestHandle;
use Modules\Classified\Repositories\LanguageSettingRepo;

class LanguageSettingService
{
    /** @var string $type */
    private $type;
    /** @var LanguageSettingRepo $repo */
    private $repo;

    /**
     * LanguageSettingService constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->repo = new LanguageSettingRepo();
        $this->type = $type;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|Language[]
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
     * @return \Illuminate\Database\Eloquent\Model|null|Language
     */
    public function create(StoreRequestHandle $request)
    {
        $attributes = [
            'title'  => $request->getTitle(),
            'status' => $request->getStatus(),
            'remark' => $request->getRemark()
        ];

        return $this->repo->create($attributes, $this->type);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Model|null|Language
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
     * @return \Illuminate\Database\Eloquent\Model|null|Language
     * @throws ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        $source = $this->repo->find($request->getId(), $this->type);
        if (is_null($source)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'title'  => $request->getTitle(),
            'status' => $request->getStatus(),
            'remark' => $request->getRemark()
        ];

        return $this->repo->update($source, $attributes);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return int
     */
    public function delete(GetIdRequestHandle $request)
    {
        return $this->repo->delete($request->getId(), $this->type);
    }
}
