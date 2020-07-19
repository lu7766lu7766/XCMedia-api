<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/12
 * Time: 下午 03:04
 */

namespace Modules\Episode\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\Episode\Contracts\Entire\IEpisode;

interface IEpisodeProvider
{
    /**
     * @param int $id
     * @return IEpisode|null
     */
    public function findEnableByMediaType(int $id): ?IEpisode;

    /**
     * @param int $seriesId
     * @return Collection|IEpisode[]
     */
    public function getBySeriesId(int $seriesId): Collection;
}
