<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/11
 * Time: 下午 06:33
 */

namespace Modules\Episode\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Entities\Source;
use Modules\Episode\Entities\Episode;

class OwnerEpisodeRepo
{
    /**
     * @param Model $owner
     * @param int $id
     * @return Episode|null
     */
    public function find(Model $owner, int $id)
    {
        try {
            /** @noinspection PhpUndefinedMethodInspection */
            $result = $owner->episodes()->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Model $owner
     * @param int $page
     * @param int $perpage
     * @return Episode[]|Collection
     */
    public function get(Model $owner, int $page = 1, int $perpage = 20)
    {
        try {
            /** @noinspection PhpUndefinedMethodInspection */
            $result = $owner->episodes()
                ->forPage($page, $perpage)
                ->orderByDesc('id')
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Model $owner
     * @return int
     */
    public function count(Model $owner)
    {
        try {
            /** @noinspection PhpUndefinedMethodInspection */
            $result = $owner->episodes()->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Model $owner
     * @param array $attribute
     * @return Episode|null
     */
    public function create(Model $owner, array $attribute)
    {
        try {
            /** @noinspection PhpUndefinedMethodInspection */
            $result = $owner->episodes()->create($attribute);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Model $owner
     * @param int $id
     * @return int
     */
    public function delete(Model $owner, int $id)
    {
        try {
            /** @noinspection PhpUndefinedMethodInspection */
            $result = $owner->episodes()->wherekey($id)->delete($id);
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Model $owner
     * @param int $sourceId
     * @param array $titles
     * @return bool
     */
    public function isAlreadyExist(Model $owner, int $sourceId, array $titles)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        /** @var MorphMany $episodesRelation */
        $episodesRelation = $owner->episodes();

        return $episodesRelation->whereHas('sources', function (Builder $query) use ($sourceId) {
            $query->where('source_id', $sourceId);
        })->whereIn('title', $titles)->exists();
    }

    /**
     * @param Model $owner
     * @param Source $source
     * @param string $title
     * @param string $openingTime
     * @param string $status
     * @param string $url
     * @return Episode
     * @throws ApiErrorCodeException
     */
    public function batchSync(
        Model $owner,
        Source $source,
        string $title,
        string $openingTime,
        string $status,
        string $url
    ) {
        /** @noinspection PhpUndefinedMethodInspection */
        /** @var MorphMany $episodesRelation */
        $episodesRelation = $owner->episodes();
        /** @var Episode $episode */
        $episode = $episodesRelation->updateOrCreate(['title' => $title], [
            'opening_time' => $openingTime,
            'status'       => $status
        ]);
        if ($episode->sources()->whereKey($source->getKey())->exists()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'Episode with this source already existed.');
        }
        $episode->sources()->attach($source->getKey(), [
            'url' => $url
        ]);
        $episode->load('sources');

        return $episode;
    }
}
