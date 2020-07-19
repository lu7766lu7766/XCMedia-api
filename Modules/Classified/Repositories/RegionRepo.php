<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/1/30
 * Time: 下午 05:22
 */

namespace Modules\Classified\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Entities\Region;

class RegionRepo implements IRegionProvider
{
    /**
     * @param string $usedType
     * @return Region[]|Collection
     */
    public function getEnableByUsedType(string $usedType)
    {
        try {
            $result = Region::where('used_type', $usedType)
                ->where('status', NYEnumConstants::YES)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = Collection::make();
        }

        return $result;
    }

    /**
     * @param string $usedType
     * @param string|null $name
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Region[]|Collection
     */
    public function book(
        string $usedType,
        string $name = null,
        string $status = null,
        int $page = 1,
        int $perpage = 25
    ) {
        try {
            $query = Region::query()->where('used_type', $usedType);
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($name)) {
                $query->where('name', 'like', '%' . $name . '%');
            }
            $regions = $query->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $regions = Collection::make();
        }

        return $regions;
    }

    /**
     * @param string $usedType
     * @param string|null $name
     * @param string|null $status
     * @return int
     */
    public function count(
        string $usedType,
        string $name = null,
        string $status = null
    ) {
        try {
            $query = Region::query()->where('used_type', $usedType);
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($name)) {
                $query->where('name', 'like', '%' . $name . '%');
            }
            $total = $query->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $total = 0;
        }

        return $total;
    }

    /**
     * @param int $id
     * @param string $usedType
     * @return Region|null
     */
    public function findByType(int $id, string $usedType)
    {
        try {
            $region = Region::query()->where('used_type', $usedType)->whereKey($id)->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $region = null;
        }

        return $region;
    }

    /**
     * @param int $id
     * @param string $usedType
     * @return Region|null
     */
    public function findEnableByType(int $id, string $usedType)
    {
        try {
            $region = Region::query()->where('used_type', $usedType)->whereKey($id)->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $region = null;
        }

        return $region;
    }

    /**
     * @param array $attributes
     * @return Region|null
     */
    public function create(array $attributes)
    {
        try {
            $region = Region::create($attributes);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $region = null;
        }

        return $region;
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function insert(array $attributes)
    {
        try {
            $region = Region::query()->insert($attributes);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $region = false;
        }

        return $region;
    }

    /**
     * @param string $usedType
     * @param array $name
     * @return Region[]|Collection
     */
    public function whereInByName(string $usedType, array $name)
    {
        try {
            $region = Region::whereIn('name', $name)
                ->where('used_type', $usedType)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $region = Collection::make();
        }

        return $region;
    }
}
