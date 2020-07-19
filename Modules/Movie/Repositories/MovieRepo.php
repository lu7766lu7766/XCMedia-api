<?php

namespace Modules\Movie\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Contracts\IClassifiedEntity;
use Modules\Classified\Contracts\ILeaderBoardProvider;
use Modules\Classified\Contracts\ISearchEngine;
use Modules\Episode\Contracts\IEpisodeOwnerRepo;
use Modules\Member\Contracts\ICommentProvider;
use Modules\Member\Contracts\IFavoriteProvider;
use Modules\Movie\Entities\Movie;

class MovieRepo implements IEpisodeOwnerRepo, IFavoriteProvider, ICommentProvider, ILeaderBoardProvider, ISearchEngine
{
    /**
     * @param string|null $name
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Collection|Movie[]
     */
    public function list(
        string $name = null,
        int $regionId = null,
        int $yearsId = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $builder = $this->getListQuery($name, $regionId, $yearsId, $status);
            $result = $builder->with(['region', 'years', 'language', 'genres', 'editorFiles'])
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
     * @param string|null $name
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param string|null $status
     * @return int
     */
    public function total(
        string $name = null,
        int $regionId = null,
        int $yearsId = null,
        string $status = null
    ) {
        try {
            $builder = $this->getListQuery($name, $regionId, $yearsId, $status);
            $result = $builder->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return Movie|null
     */
    public function findById(int $id)
    {
        try {
            /** @var Movie|null $result */
            $result = Movie::with(['region', 'years', 'language', 'genres', 'editorFiles'])
                ->whereKey($id)
                ->first();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Movie $movie
     * @param array $attributes
     * @return Movie|null
     */
    public function create(Movie $movie, array $attributes)
    {
        try {
            $create = $movie->fill($attributes)->save();
            $result = $create ? $movie : null;
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Movie $movie
     * @param array $attributes
     * @return Movie|null
     */
    public function update(Movie $movie, array $attributes)
    {
        try {
            $update = $movie->update($attributes);
            $result = $update ? $movie : null;
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return int
     */
    public function del(int $id)
    {
        try {
            $del = Movie::destroy($id);
            $result = $del > 0 ? $del : 0;
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $name
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param string|null $status
     * @return Builder
     */
    private function getListQuery(
        string $name = null,
        int $regionId = null,
        int $yearsId = null,
        string $status = null
    ) {
        $builder = Movie::whereHas('region', function (Builder $builder) {
            $builder->where('region.used_type', ClassifiedConstant::MOVIE);
        })
            ->whereHas('years', function (Builder $builder) {
                $builder->where('years.used_type', ClassifiedConstant::MOVIE);
            });
        if (!is_null($name)) {
            $builder->where('name', 'like', "%{$name}%");
        }
        if (!is_null($regionId)) {
            $builder->where('region_id', $regionId);
        }
        if (!is_null($yearsId)) {
            $builder->where('years_id', $yearsId);
        }
        if (!is_null($status)) {
            $builder->where('status', $status);
        }

        return $builder;
    }

    /**
     * @inheritDoc
     */
    public function getOwner(int $id): ?Model
    {
        try {
            $result = Movie::find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $take
     * @return Collection|Model[]
     */
    public function getPopular(int $take): Collection
    {
        try {
            $movies = Movie::query()
                ->where('status', NYEnumConstants::YES)
                ->whereHas('region', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('years', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('episodes', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES)
                        ->where('opening_time', '<=', Carbon::now());
                })->whereHas('genres', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES);
                })->latest('views')->take($take)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $movies = Collection::make();
        }

        return $movies;
    }

    /**
     * @return Movie[]|Collection
     */
    public function limitTen()
    {
        try {
            $result = Movie::where('status', NYEnumConstants::YES)
                ->with([
                    'episodes' => function (MorphMany $builder) {
                        $builder->where('episode.status', NYEnumConstants::YES)
                            ->where('opening_time', '<=', Carbon::now());
                    }
                ])
                ->whereHas('episodes', function (Builder $builder) {
                    $builder->where('status', NYEnumConstants::YES)
                        ->where('opening_time', '<=', Carbon::now());
                })
                ->latest('id')
                ->limit(10)
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $keyword
     * @param int $page
     * @param int $perpage
     * @return Collection|Model[]
     */
    public function resultsPages(string $keyword, int $page, int $perpage): Collection
    {
        try {
            $movies = Movie::where('name', 'like', '%' . $keyword . '%')
                ->where('status', NYEnumConstants::YES)
                ->whereHas('episodes', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES)
                        ->where('opening_time', '<=', Carbon::now())
                        ->whereHas('sources', function (Builder $query) {
                            $query->where('status', NYEnumConstants::YES);
                        });
                })->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $movies = Collection::make();
        }

        return $movies;
    }

    /**
     * @param string $keyword
     * @return int
     */
    public function resultCount(string $keyword): int
    {
        try {
            $count = Movie::where('name', 'like', '%' . $keyword . '%')
                ->where('status', NYEnumConstants::YES)
                ->whereHas('episodes', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES)
                        ->where('opening_time', '<=', Carbon::now())
                        ->whereHas('sources', function (Builder $query) {
                            $query->where('status', NYEnumConstants::YES);
                        });
                })->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $count = 0;
        }

        return $count;
    }

    /**
     * @param int $id
     * @return IClassifiedEntity|null
     */
    public function findEnable(int $id): ?IClassifiedEntity
    {
        try {
            $result = Movie::where('status', NYEnumConstants::YES)->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param int $memberId
     * @return bool
     */
    public function isFavoriteByMember(int $id, int $memberId)
    {
        try {
            $result = Movie::whereKey($id)
                ->whereHas('collector', function (Builder $builder) use ($memberId) {
                    $builder->whereKey($memberId);
                })
                ->exists();
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
