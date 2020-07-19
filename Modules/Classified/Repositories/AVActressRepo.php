<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 上午 11:25
 */

namespace Modules\Classified\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IActressProvider;
use Modules\Classified\Entities\AVActress;

class AVActressRepo implements IActressProvider
{
    /**
     * @param string $usedType
     * @param null|string $keyword
     * @param null|string $status
     * @param int $page
     * @param int $perpage
     * @return AVActress[]|Collection
     */
    public function book(string $usedType, ?string $keyword, ?string $status, int $page = 1, int $perpage = 25)
    {
        try {
            $query = AVActress::where('used_type', $usedType);
            if (!is_null($keyword)) {
                $query->where('name', 'like', '%' . $keyword . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $actresses = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $actresses = Collection::make();
        }

        return $actresses;
    }

    /**
     * @param array $attribute
     * @return AVActress|null
     */
    public function create(array $attribute)
    {
        try {
            $actress = AVActress::create($attribute);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $actress = null;
        }

        return $actress;
    }

    /**
     * @param int $id
     * @param string $usedType
     * @return AVActress|null
     */
    public function findByUsedType(int $id, string $usedType)
    {
        try {
            $actress = AVActress::where('used_type', $usedType)->whereKey($id)->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $actress = null;
        }

        return $actress;
    }

    /**
     * @param string $usedType
     * @param null|string $keyword
     * @param null|string $status
     * @return int
     */
    public function count(string $usedType, ?string $keyword, ?string $status)
    {
        try {
            $query = AVActress::where('used_type', $usedType);
            if (!is_null($keyword)) {
                $query->where('name', 'like', '%' . $keyword . '%');
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
     * @param array $ids
     * @param string $usedType
     * @return AVActress[]|Collection
     */
    public function findEnableByUsedType(array $ids, string $usedType)
    {
        try {
            $actresses = AVActress::whereKey($ids)
                ->where('status', NYEnumConstants::YES)
                ->where('used_type', $usedType)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $actresses = Collection::make();
        }

        return $actresses;
    }

    /**
     * @param string $usedType
     * @return AVActress[]|Collection
     */
    public function getEnableByUsedType(string $usedType)
    {
        try {
            $actresses = AVActress::where('used_type', $usedType)
                ->where('used_type', $usedType)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $actresses = Collection::make();
        }

        return $actresses;
    }
}
