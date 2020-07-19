<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/30
 * Time: 下午 05:30
 */

namespace Modules\Classified\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Classified\Entities\Years;

class YearsSettingRepo implements IYearsProvider
{
    /**
     * @param string $usedType
     * @return Years[]|Collection
     */
    public function getEnableByType(string $usedType)
    {
        try {
            $result = Years::where('used_type', $usedType)
                ->where('status', NYEnumConstants::YES)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = Collection::make();
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string $type
     * @return Years|null
     */
    public function find(int $id, string $type)
    {
        try {
            $result = Years::where('used_type', $type)->where('status', NYEnumConstants::YES)->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $type
     * @param string|null $title
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Years[]|Collection
     */
    public function get(
        string $type,
        string $title = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Years::where('used_type', $type);
            if (!is_null($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $type
     * @param string|null $title
     * @param string|null $status
     * @return int
     */
    public function count(string $type, string $title = null, string $status = null)
    {
        try {
            $query = Years::where('used_type', $type);
            if (!is_null($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }
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
     * @param array $attributes
     * @param string $type
     * @return Years|null
     */
    public function create(array $attributes, string $type)
    {
        try {
            $attributes['used_type'] = $type;
            $result = Years::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function insert(array $attributes)
    {
        try {
            $result = Years::query()->insert($attributes);
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Years $years
     * @param array $attributes
     * @return Years|null
     */
    public function update(Years $years, array $attributes)
    {
        try {
            $years->update($attributes);
            $result = $years;
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string $type
     * @return int
     */
    public function delete(int $id, string $type)
    {
        try {
            $result = Years::where('used_type', $type)->where('id', $id)->delete();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string $type
     * @return Years|null
     */
    public function findEnableByType(int $id, string $type)
    {
        try {
            $result = Years::where('used_type', $type)->where('status', NYEnumConstants::YES)->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $usedType
     * @param array $title
     * @return Years[]|Collection
     */
    public function whereInByTitle(string $usedType, array $title)
    {
        try {
            $region = Years::whereIn('title', $title)
                ->where('used_type', $usedType)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $region = Collection::make();
        }

        return $region;
    }
}
