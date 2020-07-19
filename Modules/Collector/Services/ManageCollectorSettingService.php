<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 03:15
 */

namespace Modules\Collector\Services;

use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Collector\Entities\CollectorSetting;
use Modules\Collector\Http\Requests\GetIdRequestHandle;
use Modules\Collector\Http\Requests\ListRequestHandle;
use Modules\Collector\Http\Requests\StoreRequestHandle;
use Modules\Collector\Http\Requests\UpdateRequestHandle;
use Modules\Collector\Repositories\CollectorSourceRepo;
use Modules\Collector\Repositories\ManageCollectorSettingRepo;

class ManageCollectorSettingService
{
    /** @var ManageCollectorSettingRepo $repo */
    private $repo;
    /** @var CollectorSourceRepo $SourceRepo */
    private $SourceRepo;

    /**
     * ManageCollectorSettingService constructor.
     */
    public function __construct()
    {
        $this->repo = new ManageCollectorSettingRepo();
        $this->SourceRepo = new CollectorSourceRepo();
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|CollectorSetting[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage(),
            $request->getKeyword()
        )->load(['type', 'platform']);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return $this->repo->count($request->getStatus());
    }

    /**
     * @param StoreRequestHandle $request
     * @return CollectorSetting|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function add(StoreRequestHandle $request)
    {
        $result = null;
        $source = $this->SourceRepo->find($request->getSourceId());
        if (is_null($source)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        \DB::transaction(function () use ($source, $request, &$result) {
            /** @var CollectorSetting $setting */
            $setting = $source->setting()->create(['status' => $request->getStatus()]);
            $setting->platform()->sync($request->getPlatformIds());
            $setting->type()->sync($request->getTypeIds());
            $result = $setting->load(['type', 'platform']);
        });

        return $result;
    }

    /**
     * @param GetIdRequestHandle $request
     * @return CollectorSetting|null
     */
    public function info(GetIdRequestHandle $request)
    {
        return $this->repo->find($request->getId())->load(['type', 'platform']);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return CollectorSetting|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        $result = null;
        $source = $this->SourceRepo->find($request->getSourceId());
        $setting = $this->repo->find($request->getId());
        if (is_null($source) || is_null($setting)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        \DB::transaction(function () use ($setting, $source, $request, &$result) {
            $setting->fill(['status' => $request->getStatus()])->source()->associate($source)->save();
            $setting->platform()->sync($request->getPlatformIds());
            $setting->type()->sync($request->getTypeIds());
            $result = $setting->load(['type', 'platform']);
        });

        return $result;
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
