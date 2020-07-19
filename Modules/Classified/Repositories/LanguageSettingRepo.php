<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/3
 * Time: 下午 07:29
 */

namespace Modules\Classified\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\ILanguageProvider;
use Modules\Classified\Entities\Language;

class LanguageSettingRepo implements ILanguageProvider
{
    /**
     * @param string $usedType
     * @return Language[]|Collection
     */
    public function getAllByUsedType(string $usedType): Collection
    {
        try {
            $result = Language::where('used_type', $usedType)
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
     * @return Language|null
     */
    public function find(int $id, string $type)
    {
        try {
            $result = Language::where('used_type', $type)->find($id);
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
     * @return Language[]|Collection
     */
    public function get(
        string $type,
        string $title = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Language::where('used_type', $type);
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
            $query = Language::where('used_type', $type);
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
     * @return Language|null
     */
    public function create(array $attributes, string $type)
    {
        try {
            $attributes['used_type'] = $type;
            $result = Language::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Language $source
     * @param array $attributes
     * @return Language|null
     */
    public function update(Language $source, array $attributes)
    {
        try {
            $source->update($attributes);
            $result = $source;
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
            $result = Language::where('used_type', $type)->where('id', $id)->delete();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string $type
     * @return Language|null
     */
    public function findEnableByType(int $id, string $type)
    {
        try {
            $result = Language::where('used_type', $type)
                ->where('status', NYEnumConstants::YES)
                ->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
