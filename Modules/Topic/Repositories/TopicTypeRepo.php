<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/6
 * Time: 上午 09:59
 */

namespace Modules\Topic\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Topic\Entities\Topic;

class TopicTypeRepo
{
    /**
     * @param int $id
     * @param string $type
     * @return Topic|null
     */
    public function find(int $id, string $type)
    {
        try {
            $result = Topic::where('used_type', $type)->find($id);
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
     * @return Topic[]|Collection
     */
    public function get(
        string $type,
        string $title = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Topic::where('used_type', $type);
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
            $query = Topic::where('used_type', $type);
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
     * @return Topic|null
     */
    public function create(array $attributes, string $type)
    {
        try {
            $attributes['used_type'] = $type;
            $result = Topic::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Topic $topic
     * @param array $attributes
     * @return Topic|null
     */
    public function update(Topic $topic, array $attributes)
    {
        try {
            $topic->update($attributes);
            $result = $topic;
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
