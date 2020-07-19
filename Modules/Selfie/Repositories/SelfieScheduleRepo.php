<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/26
 * Time: 下午 07:40
 */

namespace Modules\Selfie\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Selfie\Entities\SelfieSchedule;
use XC\Independent\Kit\Support\Scalar\ArrayMaster;

class SelfieScheduleRepo
{
    /**
     * @param bool|null $isCensored
     * @param int|null $regionId
     * @param array $avActressIds
     * @param int|null $cupId
     * @param int|null $yearsId
     * @param null|string $status
     * @param null|string $keyword
     * @param int $page
     * @param int $perpage
     * @return SelfieSchedule[]|Collection
     */
    public function book(
        ?string $isCensored,
        ?int $regionId,
        array $avActressIds,
        ?int $cupId,
        ?int $yearsId,
        ?string $status,
        ?string $keyword,
        int $page = 1,
        int $perpage = 25
    ) {
        try {
            $query = SelfieSchedule::query()
                ->whereHas('region', function (Builder $query) use ($regionId) {
                    if (!is_null($regionId)) {
                        $query->whereKey($regionId);
                    }
                })->whereHas('cup', function (Builder $query) use ($cupId) {
                    if (!is_null($cupId)) {
                        $query->whereKey($cupId);
                    }
                })->whereHas('years', function (Builder $query) use ($yearsId) {
                    if (!is_null($yearsId)) {
                        $query->whereKey($yearsId);
                    }
                })->whereHas('actress', function (Builder $query) use ($avActressIds) {
                    if (ArrayMaster::isList($avActressIds)) {
                        $query->whereKey($avActressIds);
                    }
                })->forPage($page, $perpage)
                ->orderByDesc('id');
            if (!is_null($isCensored)) {
                $query->where('is_censored', $isCensored);
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($keyword)) {
                $query->where('title', 'like', '%' . $keyword . '%');
            }
            $schedule = $query->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $schedule = Collection::make();
        }

        return $schedule;
    }

    /**
     * @param int $id
     * @return SelfieSchedule|null
     */
    public function find(int $id)
    {
        try {
            $schedule = SelfieSchedule::find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $schedule = null;
        }

        return $schedule;
    }

    /**
     * @param bool|null $isCensored
     * @param int|null $regionId
     * @param array $avActressIds
     * @param int|null $cupId
     * @param int|null $yearsId
     * @param null|string $status
     * @param null|string $keyword
     * @return int
     */
    public function count(
        ?bool $isCensored,
        ?int $regionId,
        array $avActressIds,
        ?int $cupId,
        ?int $yearsId,
        ?string $status,
        ?string $keyword
    ) {
        try {
            $query = SelfieSchedule::query()
                ->whereHas('region', function (Builder $query) use ($regionId) {
                    if (!is_null($regionId)) {
                        $query->whereKey($regionId);
                    }
                })->whereHas('cup', function (Builder $query) use ($cupId) {
                    if (!is_null($cupId)) {
                        $query->whereKey($cupId);
                    }
                })->whereHas('years', function (Builder $query) use ($yearsId) {
                    if (!is_null($yearsId)) {
                        $query->whereKey($yearsId);
                    }
                })->whereHas('actress', function (Builder $query) use ($avActressIds) {
                    if (ArrayMaster::isList($avActressIds)) {
                        $query->whereKey($avActressIds);
                    }
                });
            if (!is_null($isCensored)) {
                $query->where('is_censored', $isCensored);
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($keyword)) {
                $query->where('title', 'like', '%' . $keyword . '%');
            }
            $count = $query->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $count = 0;
        }

        return $count;
    }
}
