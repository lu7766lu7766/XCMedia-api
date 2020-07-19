<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/04
 * Time: 下午 06:21
 */

namespace Modules\Literature\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Literature\Entities\Literature;

class LiteratureRepo
{
    /**
     * @param string|null $title
     * @param int|null $regionId
     * @param array $genresIds
     * @param int|null $yearId
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Literature[]|Collection
     */
    public function list(
        string $title = null,
        int $regionId = null,
        array $genresIds = [],
        int $yearId = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Literature::query()->with(['region', 'genres', 'year', 'editorFiles']);
            $query->whereHas('genres', function (Builder $builder) use ($genresIds) {
                if (!empty($genresIds)) {
                    $builder->whereIn('genres_id', $genresIds);
                }
            })->whereHas('year', function (Builder $builder) use ($yearId) {
                if (!is_null($yearId)) {
                    $builder->where('year_id', '=', $yearId);
                }
            })->whereHas('region', function (Builder $builder) use ($regionId) {
                if (!is_null($regionId)) {
                    $builder->where('region_id', '=', $regionId);
                }
            });
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($title)) {
                $query->where('title', 'LIKE', "%{$title}%");
            }
            $result = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $title
     * @param int|null $regionId
     * @param array $genresIds
     * @param int|null $yearId
     * @param string|null $status
     * @return int
     */
    public function count(
        string $title = null,
        int $regionId = null,
        array $genresIds = [],
        int $yearId = null,
        string $status = null
    ) {
        try {
            $query = Literature::query();
            $query->whereHas('genres', function (Builder $builder) use ($genresIds) {
                if (!empty($genresIds)) {
                    $builder->whereIn('genres_id', $genresIds);
                }
            })->whereHas('year', function (Builder $builder) use ($yearId) {
                if (!is_null($yearId)) {
                    $builder->where('year_id', $yearId);
                }
            })->whereHas('region', function (Builder $builder) use ($regionId) {
                if (!is_null($regionId)) {
                    $builder->where('region_id', $regionId);
                }
            });
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($title)) {
                $query->where('title', 'LIKE', "%{$title}%");
            }
            $result = $query->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Literature $literature
     * @param array $attributes
     * @return Literature|null
     */
    public function update(
        Literature $literature,
        array $attributes
    ) {
        $result = null;
        try {
            $result = $literature->update($attributes) ? $literature : null;
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string|null $status
     * @return Literature|null
     */
    public function find(int $id, string $status = null)
    {
        $result = null;
        try {
            $query = Literature::query();
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        /** @var Literature $result */
        return $result;
    }

    /**
     * @param Literature $literature
     * @return Literature|null
     */
    public function delete(Literature $literature)
    {
        $result = null;
        try {
            $literature->delete();
            $result = $literature;
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
