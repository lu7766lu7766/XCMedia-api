<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/2
 * Time: 下午 04:03
 */

namespace Modules\Branch\Services;

use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Branch\Http\Requests\DeleteRequestHandle;
use Modules\Branch\Http\Requests\ListRequestHandle;
use Modules\Branch\Http\Requests\StoreRequestHandle;
use Modules\Branch\Http\Requests\UpdateRequestHandle;
use Modules\Branch\Repositories\BranchRepo;

class ManageBranchService
{
    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Branch\Entities\Branch[]
     */
    public function list(ListRequestHandle $request)
    {
        return app(BranchRepo::class)->get(
            $request->getName(),
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
        return app(BranchRepo::class)->count(
            $request->getName(),
            $request->getStatus()
        );
    }

    /**
     * @param StoreRequestHandle $request
     * @return \Modules\Branch\Entities\Branch|null
     */
    public function add(StoreRequestHandle $request)
    {
        $attributes = [
            'code'        => $request->getCode(),
            'name'        => $request->getName(),
            'domain'      => $request->getDomain(),
            'status'      => $request->getStatus(),
            'is_register' => $request->isRegister(),
            'remark'      => $request->getRemark()
        ];

        return app(BranchRepo::class)->create($attributes);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return BranchRepo|null
     * @throws ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        $branch = app(BranchRepo::class)->find($request->getId());
        if (is_null($branch)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'name'        => $request->getName(),
            'domain'      => $request->getDomain(),
            'status'      => $request->getStatus(),
            'is_register' => $request->isRegister(),
            'remark'      => $request->getRemark()
        ];

        return app(BranchRepo::class)->update($branch, $attributes);
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     */
    public function delete(DeleteRequestHandle $request)
    {
        return app(BranchRepo::class)->delete($request->getId());
    }
}
