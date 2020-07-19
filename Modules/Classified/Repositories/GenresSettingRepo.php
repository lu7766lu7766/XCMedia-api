<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/1/30
 * Time: 下午 05:36
 */

namespace Modules\Classified\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Entities\Genres;

class GenresSettingRepo implements IGenresProvider
{
    /**
     * @param string $usedType
     * @return Genres[]|Collection
     */
    public function getEnableUsedType(string $usedType)
    {
        try {
            $result = Genres::where('used_type', $usedType)
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
     * @return Genres|null
     */
    public function find(int $id, string $type)
    {
        try {
            $result = Genres::where('used_type', $type)->find($id);
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
     * @return Genres[]|Collection
     */
    public function get(
        string $type,
        string $title = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Genres::where('used_type', $type);
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
            $query = Genres::where('used_type', $type);
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
     * @return Genres|null
     */
    public function create(array $attributes, string $type)
    {
        try {
            $attributes['used_type'] = $type;
            $result = Genres::create($attributes);
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
            $result = Genres::query()->insert($attributes);
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Genres $genres
     * @param array $attributes
     * @return Genres|null
     */
    public function update(Genres $genres, array $attributes)
    {
        try {
            $genres->update($attributes);
            $result = $genres;
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $ids
     * @param string $type
     * @param string|null $status
     * @return Genres[]|Collection
     */
    public function getByIds(array $ids, string $type, string $status = null)
    {
        try {
            $query = Genres::whereIn('id', $ids);
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->where('used_type', $type)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $ids
     * @param string $type
     * @return Model[]|Collection
     */
    public function getByUsedTyp(array $ids, string $type)
    {
        try {
            $genres = Genres::whereKey($ids)->where('used_type', $type)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $genres = Collection::make();
        }

        return $genres;
    }

    /**
     * @param array $ids
     * @param string $type
     * @return Genres[]|Collection
     */
    public function getEnableByIds(array $ids, string $type)
    {
        try {
            $result = Genres::where('used_type', $type)
                ->where('status', NYEnumConstants::YES)
                ->whereIn('id', $ids)
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $usedType
     * @param array $title
     * @return Genres[]|Collection
     */
    public function whereInByTitle(string $usedType, array $title)
    {
        try {
            $region = Genres::whereIn('title', $title)
                ->where('used_type', $usedType)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $region = Collection::make();
        }

        return $region;
    }
}
