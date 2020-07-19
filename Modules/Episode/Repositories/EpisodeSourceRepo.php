<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/13
 * Time: 下午 04:49
 */

namespace Modules\Episode\Repositories;

use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Episode\Entities\EpisodeSource;

class EpisodeSourceRepo
{
    /**
     * @param array $attribute
     * @return bool
     */
    public function create(array $attribute)
    {
        try {
            $result = EpisodeSource::query()->insert($attribute);
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
