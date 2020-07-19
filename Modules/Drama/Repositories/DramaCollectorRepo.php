<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/4/16
 * Time: 下午 07:34
 */

namespace Modules\Drama\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IMediaCollector;
use Modules\Drama\Entities\Drama;

class DramaCollectorRepo implements IMediaCollector
{
    /**
     * @param array $title
     * @return Drama[]|Collection
     */
    public function whereInByTitle(array $title)
    {
        try {
            $result = Drama::query()->whereIn('title', $title)->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return Drama|null
     */
    public function create(array $attributes)
    {
        try {
            $result = Drama::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
