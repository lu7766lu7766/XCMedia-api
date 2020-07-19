<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 03:50
 */

namespace Modules\Collector\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Collector\Entities\CollectorSetting;

class ManageCollectorSettingRepo
{
    /**
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @param string|null $keyword
     * @return CollectorSetting[]|Collection
     */
    public function get(string $status = null, int $page = 1, int $perpage = 20, string $keyword = null)
    {
        try {
            $query = CollectorSetting::query()->whereHas('source', function (Builder $query) use ($keyword) {
                if (!is_null($keyword)) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                }
            });
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $status
     * @return int
     */
    public function count(string $status = null)
    {
        try {
            $query = CollectorSetting::query();
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string|null $status
     * @return CollectorSetting|null
     */
    public function find(int $id, string $status = null)
    {
        try {
            $query = CollectorSetting::whereKey($id);
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->first();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        try {
            $result = CollectorSetting::whereKey($id)->delete();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
