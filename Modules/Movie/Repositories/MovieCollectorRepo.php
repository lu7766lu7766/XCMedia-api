<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/4/14
 * Time: 下午 05:09
 */

namespace Modules\Movie\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IMediaCollector;
use Modules\Movie\Entities\Movie;

class MovieCollectorRepo implements IMediaCollector
{
    /**
     * @param array $title
     * @return Model[]|Collection
     */
    public function whereInByTitle(array $title)
    {
        try {
            $result = Movie::query()->whereIn('name', $title)->get(['*', 'name as title']);
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return Movie|null
     */
    public function create(array $attributes)
    {
        try {
            $result = Movie::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
