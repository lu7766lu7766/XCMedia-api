<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/12
 * Time: 下午 06:04
 */

namespace Modules\Storytelling\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Storytelling\Entities\StorytellingAudio;

class StorytellingAudioRepo
{
    /**
     * @param int $id
     * @return StorytellingAudio|null
     */
    public function find(int $id)
    {
        try {
            $result = StorytellingAudio::find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $storytellingId
     * @param int $page
     * @param int $perpage
     * @return StorytellingAudio[]|Collection
     */
    public function get(int $storytellingId, int $page, int $perpage)
    {
        try {
            $audios = StorytellingAudio::whereHas('storytelling', function (Builder $query) use ($storytellingId) {
                $query->whereKey($storytellingId);
            })->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $audios = collect();
        }

        return $audios;
    }

    /**
     * @param int $storytellingId
     * @return int
     */
    public function count(int $storytellingId)
    {
        try {
            $audios = StorytellingAudio::whereHas('storytelling', function (Builder $query) use ($storytellingId) {
                $query->whereKey($storytellingId);
            })->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $audios = 0;
        }

        return $audios;
    }

    /**
     * @param StorytellingAudio $storytellingAudio
     * @return bool
     */
    public function delete(StorytellingAudio $storytellingAudio)
    {
        try {
            $result = $storytellingAudio->delete();
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
