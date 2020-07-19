<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 02:46
 */

namespace Modules\FeatureFilm\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\FeatureFilm\Entities\FeatureFilm;

class FeatureFilmRepo
{
    /**
     * @param string|null $mosaicType
     * @param int|null $regionId
     * @param array $avActressIds
     * @param array $genresIds
     * @param int|null $cupId
     * @param int|null $yearId
     * @param string|null $status
     * @param string|null $title
     * @param int $page
     * @param int $perpage
     * @return FeatureFilm[]|Collection
     */
    public function list(
        string $mosaicType = null,
        int $regionId = null,
        array $avActressIds = [],
        array $genresIds = [],
        int $cupId = null,
        int $yearId = null,
        string $status = null,
        string $title = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = FeatureFilm::with(['region', 'year', 'cup', 'avActress', 'genres', 'editorFiles']);
            $query->whereHas('region', function (Builder $builder) use ($regionId) {
                is_null($regionId) ? null : $builder->where('region_id', $regionId);
            })->whereHas('year', function (Builder $builder) use ($yearId) {
                is_null($yearId) ? null : $builder->where('year_id', $yearId);
            })->whereHas('cup', function (Builder $builder) use ($cupId) {
                is_null($cupId) ? null : $builder->where('cup_id', $cupId);
            })->whereHas('avActress', function (Builder $builder) use ($avActressIds) {
                empty($avActressIds) ? null : $builder->whereIn('av_actress_id', $avActressIds);
            })->whereHas('genres', function (Builder $builder) use ($genresIds) {
                empty($genresIds) ? null : $builder->whereIn('genres_id', $genresIds);
            });
            is_null($mosaicType) ? null : $query->where('mosaic_type', $mosaicType);
            is_null($status) ? null : $query->where('status', $status);
            is_null($title) ? null : $query->where('title', 'LIKE', "%{$title}%");
            /** @var FeatureFilm[] $result */
            $result = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $mosaicType
     * @param int|null $regionId
     * @param array $avActressIds
     * @param array $genresIds
     * @param int|null $cupId
     * @param int|null $yearId
     * @param string|null $status
     * @param string|null $title
     * @return int
     */
    public function total(
        string $mosaicType = null,
        int $regionId = null,
        array $avActressIds = [],
        array $genresIds = [],
        int $cupId = null,
        int $yearId = null,
        string $status = null,
        string $title = null
    ) {
        try {
            $query = FeatureFilm::query();
            $query->whereHas('region', function (Builder $builder) use ($regionId) {
                is_null($regionId) ? null : $builder->where('region_id', $regionId);
            })->whereHas('year', function (Builder $builder) use ($yearId) {
                is_null($yearId) ? null : $builder->where('year_id', $yearId);
            })->whereHas('cup', function (Builder $builder) use ($cupId) {
                is_null($cupId) ? null : $builder->where('cup_id', $cupId);
            })->whereHas('avActress', function (Builder $builder) use ($avActressIds) {
                empty($avActressIds) ? null : $builder->whereIn('av_actress_id', $avActressIds);
            })->whereHas('genres', function (Builder $builder) use ($genresIds) {
                empty($genresIds) ? null : $builder->whereIn('genres_id', $genresIds);
            });
            is_null($mosaicType) ? null : $query->where('mosaic_type', $mosaicType);
            is_null($status) ? null : $query->where('status', $status);
            is_null($title) ? null : $query->where('title', 'LIKE', "%{$title}%");
            /** @var int $result */
            $result = $query->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param FeatureFilm $featureFilm
     * @param array $attributes
     * @return FeatureFilm|null
     */
    public function update(FeatureFilm $featureFilm, array $attributes)
    {
        $result = null;
        try {
            $result = $featureFilm->update($attributes) ? $featureFilm : null;
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string|null $status
     * @return FeatureFilm|null
     */
    public function find(int $id, string $status = null)
    {
        /** @var FeatureFilm $result */
        $result = null;
        try {
            $query = FeatureFilm::query();
            is_null($status) ? null : $query->where('status', $status);
            $result = $query->find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param FeatureFilm $featureFilm
     * @return FeatureFilm
     */
    public function delete(FeatureFilm $featureFilm)
    {
        /** @var FeatureFilm $result */
        $result = null;
        try {
            $featureFilm->delete();
            $result = $featureFilm;
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
