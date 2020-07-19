<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/11
 * Time: 下午 03:34
 */

namespace Modules\Storytelling\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Storytelling\Entities\Storytelling;

class StorytellingRepo
{
    /**
     * @param array $attributes
     * @return Storytelling|null
     */
    public function create(array $attributes)
    {
        try {
            $result = Storytelling::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return Storytelling|null
     */
    public function find(int $id)
    {
        try {
            $result = Storytelling::find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $title
     * @param string|null $status
     * @param int|null $yearsId
     * @param int|null $regionId
     * @param int $page
     * @param int $perpage
     * @return Collection|Storytelling[]
     */
    public function get(
        string $title = null,
        string $status = null,
        int $yearsId = null,
        int $regionId = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Storytelling::whereHas('years', function (Builder $builder) use ($yearsId) {
                if (!is_null($yearsId)) {
                    $builder->whereKey($yearsId);
                }
            })->whereHas('region', function (Builder $builder) use ($regionId) {
                if (!is_null($regionId)) {
                    $builder->whereKey($regionId);
                }
            });
            if (!is_null($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->forPage($page, $perpage)->orderByDesc('id')->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $title
     * @param string|null $status
     * @param int|null $yearsId
     * @param int|null $regionId
     * @return int
     */
    public function count(
        string $title = null,
        string $status = null,
        int $yearsId = null,
        int $regionId = null
    ) {
        try {
            $query = Storytelling::whereHas('years', function (Builder $builder) use ($yearsId) {
                if (!is_null($yearsId)) {
                    $builder->whereKey($yearsId);
                }
            })->whereHas('region', function (Builder $builder) use ($regionId) {
                if (!is_null($regionId)) {
                    $builder->whereKey($regionId);
                }
            });
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
     * @param Storytelling $storytelling
     * @return bool
     */
    public function delete(Storytelling $storytelling)
    {
        try {
            $result = $storytelling->delete();
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
