<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 03:25
 */

namespace Modules\Video\Repositories;

use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Video\Entities\AdultVideo;
use Modules\Video\Entities\AdultVideoBucket;

class AdultVideoBucketRepo
{
    /**
     * @param int $id
     * @return AdultVideoBucket|null
     */
    public function find(int $id)
    {
        try {
            $bucket = AdultVideoBucket::find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $bucket = null;
        }

        return $bucket;
    }

    /**
     * @param array $attribute
     * @return AdultVideoBucket|null
     */
    public function create(array $attribute, AdultVideo $video)
    {
        try {
            $bucket = new AdultVideoBucket($attribute);
            $bucket->headline()->associate($video);
            $bucket->save();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $bucket = null;
        }

        return $bucket;
    }
}
