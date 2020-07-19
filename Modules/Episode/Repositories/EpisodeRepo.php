<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/12
 * Time: 下午 02:36
 */

namespace Modules\Episode\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Episode\Contracts\Entire\IEpisode;
use Modules\Episode\Contracts\IEpisodeProvider;
use Modules\Episode\Entities\Episode;

class EpisodeRepo implements IEpisodeProvider
{
    /**
     * @param int $id
     * @return IEpisode|null
     */
    public function findEnableByMediaType(int $id): ?IEpisode
    {
        try {
            /** @var  Episode|null $episode */
            $episode = Episode::query()->whereHasMorph('series', ['*'], function (Builder $query) {
                $query->where('status', NYEnumConstants::YES);
            })->where('status', NYEnumConstants::YES)->find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $episode = null;
        }

        return $episode;
    }

    /**
     * @param int $seriesId
     * @return Collection|IEpisode[]
     */
    public function getBySeriesId(int $seriesId): Collection
    {
        try {
            $episodes = Episode::query()->whereHasMorph('series', ['*'], function (Builder $query) use ($seriesId) {
                $query->whereKey($seriesId);
            })->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $episodes = Collection::make();
        }

        return $episodes;
    }
}
