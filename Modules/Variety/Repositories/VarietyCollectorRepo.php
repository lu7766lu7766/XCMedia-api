<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/4/16
 * Time: 下午 07:39
 */

namespace Modules\Variety\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IMediaCollector;
use Modules\Variety\Entities\Variety;

class VarietyCollectorRepo implements IMediaCollector
{
    /**
     * @param array $title
     * @return Variety[]|Collection
     */
    public function whereInByTitle(array $title)
    {
        try {
            $result = Variety::query()->whereIn('title', $title)->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return Variety|null
     */
    public function create(array $attributes)
    {
        try {
            $result = Variety::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
