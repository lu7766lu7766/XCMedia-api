<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/9
 * Time: 下午 03:51
 */

namespace Modules\Advertisement\Repositories;

use Modules\Advertisement\Entities\AdvertisementType;
use Modules\Base\Util\LaravelLoggerUtil;

class AdvertisementTypeRepo
{
    /**
     * @param int $id
     * @return AdvertisementType|null
     */
    public function find(int $id)
    {
        try {
            $result = AdvertisementType::find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|AdvertisementType[]
     */
    public function all()
    {
        try {
            $result = AdvertisementType::all();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
