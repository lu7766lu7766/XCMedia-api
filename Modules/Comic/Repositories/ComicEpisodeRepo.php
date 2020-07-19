<?php

namespace Modules\Comic\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Comic\Entities\ComicEpisode;

class ComicEpisodeRepo
{
    /**
     * @param int $comicId
     * @param int $page
     * @param int $perpage
     * @return Collection|ComicEpisode[]
     */
    public function list(int $comicId, int $page = 1, int $perpage = 20)
    {
        try {
            $result = ComicEpisode::whereHas('comic', function (Builder $builder) use ($comicId) {
                $builder->whereKey($comicId);
            })
                ->orderByDesc('id')
                ->forPage($page, $perpage)
                ->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $comicId
     * @return int
     */
    public function total(int $comicId)
    {
        try {
            $result = ComicEpisode::whereHas('comic', function (Builder $builder) use ($comicId) {
                $builder->whereKey($comicId);
            })
                ->where('comic_id', $comicId)
                ->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return ComicEpisode|null
     */
    public function findById(int $id)
    {
        try {
            /** @var ComicEpisode|null $result */
            $result = ComicEpisode::whereKey($id)->first();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param ComicEpisode $comicEpisode
     * @param array $attributes
     * @return bool
     */
    public function update(ComicEpisode $comicEpisode, array $attributes)
    {
        try {
            $update = $comicEpisode->update($attributes);
            $result = $update ? true : false;
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param ComicEpisode $comicEpisode
     * @return int
     */
    public function del(ComicEpisode $comicEpisode)
    {
        try {
            $result = $comicEpisode->delete();
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
