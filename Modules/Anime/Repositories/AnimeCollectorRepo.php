<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/4/16
 * Time: 下午 07:36
 */

namespace Modules\Anime\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Anime\Entities\Anime;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IMediaCollector;

class AnimeCollectorRepo implements IMediaCollector
{
    /**
     * @param array $title
     * @return Anime[]|Collection
     */
    public function whereInByTitle(array $title)
    {
        try {
            $result = Anime::query()->whereIn('title', $title)->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return Anime|null
     */
    public function create(array $attributes)
    {
        try {
            $result = Anime::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
