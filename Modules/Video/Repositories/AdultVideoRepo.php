<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/3
 * Time: 下午 02:53
 */

namespace Modules\Video\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Video\Entities\AdultVideo;
use XC\Independent\Kit\Support\Scalar\ArrayMaster;

class AdultVideoRepo
{
    /**
     * @param int|null $regionId
     * @param array $avActressIds
     * @param int|null $cupId
     * @param int|null $yearsId
     * @param null|string $status
     * @param null|string $keyword
     * @param int $page
     * @param int $perpage
     * @return AdultVideo[]|Collection
     */
    public function book(
        ?int $regionId,
        array $avActressIds,
        ?int $cupId,
        ?int $yearsId,
        ?string $status,
        ?string $keyword,
        int $page,
        int $perpage
    ) {
        try {
            $query = AdultVideo::whereHas('source', function (Builder $query) use ($regionId) {
                if (!is_null($regionId)) {
                    $query->whereKey($regionId);
                }
            })->whereHas('actress', function (Builder $query) use ($avActressIds) {
                if (ArrayMaster::isList($avActressIds)) {
                    $query->whereKey($avActressIds);
                }
            })->whereHas('years', function (Builder $query) use ($yearsId) {
                if (!is_null($yearsId)) {
                    $query->whereKey($yearsId);
                }
            })->whereHas('cup', function (Builder $query) use ($cupId) {
                if (!is_null($cupId)) {
                    $query->whereKey($cupId);
                }
            })->forPage($page, $perpage)->orderByDesc('id');
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($keyword)) {
                $query->where('title', 'like', '%' . $keyword . '%');
            }
            $videos = $query->get();
        } catch (\Throwable $e) {
            $videos = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $videos;
    }

    /**
     * @param int|null $regionId
     * @param array $avActressIds
     * @param int|null $cupId
     * @param int|null $yearsId
     * @param null|string $status
     * @param null|string $keyword
     * @return int
     */
    public function count(
        ?int $regionId,
        array $avActressIds,
        ?int $cupId,
        ?int $yearsId,
        ?string $status,
        ?string $keyword
    ) {
        try {
            $query = AdultVideo::whereHas('source', function (Builder $query) use ($regionId) {
                if (!is_null($regionId)) {
                    $query->whereKey($regionId);
                }
            })->whereHas('actress', function (Builder $query) use ($avActressIds) {
                if (ArrayMaster::isList($avActressIds)) {
                    $query->whereKey($avActressIds);
                }
            })->whereHas('years', function (Builder $query) use ($yearsId) {
                if (!is_null($yearsId)) {
                    $query->whereKey($yearsId);
                }
            })->whereHas('cup', function (Builder $query) use ($cupId) {
                if (!is_null($cupId)) {
                    $query->whereKey($cupId);
                }
            });
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

    /**
     * @param int $id
     * @return AdultVideo|null
     */
    public function find(int $id)
    {
        try {
            $video = AdultVideo::find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $video = null;
        }

        return $video;
    }
}
