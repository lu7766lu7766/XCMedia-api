<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/11
 * Time: 上午 01:15
 */

namespace Modules\Collector\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Collector\Entities\CollectorPlatform;

class CollectorPlatformRepo
{
    /**
     * @return Collection|CollectorPlatform[]
     */
    public function all()
    {
        try {
            $result = CollectorPlatform::all();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
