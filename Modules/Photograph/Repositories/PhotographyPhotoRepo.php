<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 07:01
 */

namespace Modules\Photograph\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Photograph\Entities\PhotographPhoto;

class PhotographyPhotoRepo
{
    /**
     * @param int $photographyId
     * @return PhotographPhoto[]|Collection
     */
    public function getByPhotography(int $photographyId)
    {
        try {
            $photo = PhotographPhoto::whereHas('album', function (Builder $query) use ($photographyId) {
                $query->whereKey($photographyId);
            })->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $photo = Collection::make();
        }

        return $photo;
    }

    /**
     * @param int $id
     * @return PhotographPhoto|null
     */
    public function find(int $id): ?PhotographPhoto
    {
        try {
            $photo = PhotographPhoto::find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $photo = null;
        }

        return $photo;
    }
}
