<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 02:02
 */

namespace Modules\Photograph\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Photograph\Entities\PhotographAlbum;
use XC\Independent\Kit\Support\Scalar\ArrayMaster;

class PhotographAlbumRepo
{
    /**
     * @param int|null $regionId
     * @param array $avActressIds
     * @param int|null $cupId
     * @param int|null $yearsId
     * @param null|string $status
     * @param array $genresIds
     * @param null|string $keyword
     * @param int $page
     * @param int $perpage
     * @return PhotographAlbum[]|Collection
     */
    public function book(
        ?int $regionId,
        array $avActressIds,
        ?int $cupId,
        ?int $yearsId,
        ?string $status,
        array $genresIds,
        ?string $keyword,
        int $page,
        int $perpage
    ) {
        try {
            $query = PhotographAlbum::whereHas('region', function (Builder $query) use ($regionId) {
                if (!is_null($regionId)) {
                    $query->whereKey($regionId);
                }
            })->whereHas('actress', function (Builder $query) use ($avActressIds) {
                if (ArrayMaster::isList($avActressIds)) {
                    $query->whereKey($avActressIds);
                }
            })->whereHas('cup', function (Builder $query) use ($cupId) {
                if (!is_null($cupId)) {
                    $query->whereKey($cupId);
                }
            })->whereHas('years', function (Builder $query) use ($yearsId) {
                if (!is_null($yearsId)) {
                    $query->whereKey($yearsId);
                }
            })->whereHas('genres', function (Builder $query) use ($genresIds) {
                if (ArrayMaster::isList($genresIds)) {
                    $query->whereKey($genresIds);
                }
            })->orderByDesc('id')->forPage($page, $perpage);
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($keyword)) {
                $query->where('title', 'like', "%" . $keyword . "%");
            }
            $albums = $query->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $albums = Collection::make();
        }

        return $albums;
    }

    /**
     * @param int|null $regionId
     * @param array $avActressIds
     * @param int|null $cupId
     * @param int|null $yearsId
     * @param null|string $status
     * @param array $genresIds
     * @param null|string $keyword
     * @return int
     */
    public function count(
        ?int $regionId,
        array $avActressIds,
        ?int $cupId,
        ?int $yearsId,
        ?string $status,
        array $genresIds,
        ?string $keyword
    ) {
        try {
            $query = PhotographAlbum::whereHas('region', function (Builder $query) use ($regionId) {
                if (!is_null($regionId)) {
                    $query->whereKey($regionId);
                }
            })->whereHas('actress', function (Builder $query) use ($avActressIds) {
                if (ArrayMaster::isList($avActressIds)) {
                    $query->whereKey($avActressIds);
                }
            })->whereHas('cup', function (Builder $query) use ($cupId) {
                if (!is_null($cupId)) {
                    $query->whereKey($cupId);
                }
            })->whereHas('years', function (Builder $query) use ($yearsId) {
                if (!is_null($yearsId)) {
                    $query->whereKey($yearsId);
                }
            })->whereHas('genres', function (Builder $query) use ($genresIds) {
                if (ArrayMaster::isList($genresIds)) {
                    $query->whereKey($genresIds);
                }
            });
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($keyword)) {
                $query->where('title', 'like', "%" . $keyword . "%");
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
     * @return PhotographAlbum|null
     */
    public function find(int $id)
    {
        try {
            $album = PhotographAlbum::find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $album = null;
        }

        return $album;
    }
}
