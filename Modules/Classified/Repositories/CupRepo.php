<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 上午 11:16
 */

namespace Modules\Classified\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\ICupProvider;
use Modules\Classified\Entities\Cup;

class CupRepo implements ICupProvider
{
    /**
     * @param string $usedType
     * @param null|string $keyword
     * @param null|string $status
     * @return Cup[]|Collection
     */
    public function book(string $usedType, ?string $keyword, ?string $status, int $page = 1, int $perpage = 25)
    {
        try {
            $query = Cup::where('used_type', $usedType);
            if (!is_null($keyword)) {
                $query->where('size', 'like', '%' . $keyword . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $cups = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $cups = Collection::make();
        }

        return $cups;
    }

    /**
     * @param string $usedType
     * @param int $id
     * @return Cup|null
     */
    public function findByUsedType(string $usedType, int $id)
    {
        try {
            $cup = Cup::whereKey($id)->where('used_type', $usedType)->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $cup = null;
        }

        return $cup;
    }

    /**
     * @param array $attributes
     * @return Cup|null
     */
    public function create(array $attributes)
    {
        try {
            $cup = Cup::create($attributes);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $cup = null;
        }

        return $cup;
    }

    /**
     * @param string $usedType
     * @param null|string $keyword
     * @param null|string $status
     * @return int
     */
    public function total(string $usedType, ?string $keyword, ?string $status)
    {
        try {
            $query = Cup::where('used_type', $usedType);
            if (!is_null($keyword)) {
                $query->where('size', 'like', '%' . $keyword . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $count = $query->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $count = 0;
        }

        return $count;
    }

    /**
     * @param string $usedType
     * @return Cup[]|Collection
     */
    public function getEnableByUsedType(string $usedType)
    {
        try {
            $cups = Cup::where('used_type', $usedType)->where('status', NYEnumConstants::YES)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $cups = Collection::make();
        }

        return $cups;
    }
}
