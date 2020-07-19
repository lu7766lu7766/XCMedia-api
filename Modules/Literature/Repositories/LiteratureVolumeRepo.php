<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/10
 * Time: 下午 07:12
 */

namespace Modules\Literature\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Literature\Entities\Literature;
use Modules\Literature\Entities\LiteratureVolume;

class LiteratureVolumeRepo
{
    /**
     * @param int $literatureId
     * @param int $page
     * @param int $perpage
     * @return LiteratureVolume[]|Collection
     */
    public function list(int $literatureId, int $page, int $perpage)
    {
        try {
            $query = LiteratureVolume::with('literature');
            $query->whereHas('literature', function (Builder $builder) use ($literatureId) {
                $builder->whereKey($literatureId);
            });
            $result = $query->forPage($page, $perpage)->orderByDesc('id')->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @param Literature $literature
     * @return LiteratureVolume|null
     */
    public function add(array $attributes, Literature $literature)
    {
        /** @var LiteratureVolume $result */
        $result = null;
        try {
            $result = $literature->volume()->create($attributes);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $literatureId
     * @param int $id
     * @param string|null $status
     * @return LiteratureVolume|null
     */
    public function find(int $literatureId, int $id, string $status = null)
    {
        /** @var LiteratureVolume $result */
        $result = null;
        try {
            $query = Literature::find($literatureId)->volume()->whereKey($id);
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param LiteratureVolume $literatureVolume
     * @param array $attributes
     * @return LiteratureVolume
     */
    public function update(LiteratureVolume $literatureVolume, array $attributes)
    {
        $result = null;
        try {
            if ($literatureVolume->update($attributes)) {
                $result = $literatureVolume;
            }
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param LiteratureVolume $literatureVolume
     * @return LiteratureVolume|null
     */
    public function delete(LiteratureVolume $literatureVolume)
    {
        $result = null;
        try {
            $literatureVolume->delete();
            $result = $literatureVolume;
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $literatureId
     * @return int
     */
    public function count(int $literatureId)
    {
        try {
            $result = LiteratureVolume::whereHas('literature', function (Builder $builder) use ($literatureId) {
                $builder->whereKey($literatureId);
            })->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
