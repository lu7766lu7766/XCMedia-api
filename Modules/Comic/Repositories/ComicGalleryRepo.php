<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/3/10
 * Time: 下午 02:00
 */

namespace Modules\Comic\Repositories;

use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Comic\Entities\ComicGallery;

class ComicGalleryRepo
{
    /**
     * @param int $id
     * @return null|ComicGallery
     */
    public function findById(int $id)
    {
        try {
            $result = ComicGallery::whereKey($id)->first();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return ComicGallery|null
     */
    public function create(array $attributes)
    {
        try {
            $result = ComicGallery::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
