<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 12:20
 */

namespace Modules\Selfie\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Selfie\Entities\SelfieVideo;

class SelfieVideoRepo
{
    /**
     * @param int $scheduleId
     * @param int $page
     * @param int $perpage
     * @return SelfieVideo[]|Collection
     */
    public function book(int $scheduleId, int $page, int $perpage)
    {
        try {
            $videos = SelfieVideo::whereHas('schedule', function (Builder $query) use ($scheduleId) {
                $query->whereKey($scheduleId);
            })->latest('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $videos = Collection::make();
        }

        return $videos;
    }

    /**
     * @param int $scheduleId
     * @return int
     */
    public function count(int $scheduleId)
    {
        try {
            $count = SelfieVideo::whereHas('schedule', function (Builder $query) use ($scheduleId) {
                $query->whereKey($scheduleId);
            })->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $count = 0;
        }

        return $count;
    }

    /**
     * @param int $id
     * @return SelfieVideo|null
     */
    public function find(int $id)
    {
        try {
            $video = SelfieVideo::find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $video = null;
        }

        return $video;
    }
}
