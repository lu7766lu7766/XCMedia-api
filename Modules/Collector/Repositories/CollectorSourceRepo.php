<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 07:48
 */

namespace Modules\Collector\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Collector\Entities\CollectorSource;

class CollectorSourceRepo
{
    /**
     * @return Collection|CollectorSource[]
     */
    public function all()
    {
        try {
            $result = CollectorSource::all();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string|null $status
     * @return CollectorSource|null
     */
    public function find(int $id, string $status = null)
    {
        try {
            $query = CollectorSource::query();
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->whereKey($id)->first();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
