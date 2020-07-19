<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/14
 * Time: 下午 04:44
 */

namespace Modules\Anime\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Anime\Entities\Anime;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IClassifiedEntity;
use Modules\Classified\Contracts\ILeaderBoardProvider;
use Modules\Classified\Contracts\ISearchEngine;
use Modules\Episode\Contracts\IEpisodeOwnerRepo;
use Modules\Member\Contracts\ICommentProvider;
use Modules\Member\Contracts\IFavoriteProvider;
use XC\Independent\Kit\Support\Scalar\ArrayMaster;

class AnimeRepo implements IEpisodeOwnerRepo, IFavoriteProvider, ICommentProvider, ILeaderBoardProvider, ISearchEngine
{
    /**
     * @param int $id
     * @return Anime|null
     */
    public function find(int $id)
    {
        try {
            $result = Anime::find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $title
     * @param string|null $status
     * @param string|null $episodeStatus
     * @param int|null $yearsId
     * @param int|null $regionId
     * @param int $page
     * @param int $perpage
     * @return Anime[]|Collection
     */
    public function get(
        string $title = null,
        string $status = null,
        string $episodeStatus = null,
        int $yearsId = null,
        int $regionId = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Anime::whereHas('years', function (Builder $builder) use ($yearsId) {
                if (!is_null($yearsId)) {
                    $builder->whereKey($yearsId);
                }
            })->whereHas('region', function (Builder $builder) use ($regionId) {
                if (!is_null($regionId)) {
                    $builder->whereKey($regionId);
                }
            });
            if (!is_null($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($episodeStatus)) {
                $query->where('episode_status', $episodeStatus);
            }
            $result = $query->forPage($page, $perpage)->orderByDesc('id')->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $title
     * @param string|null $status
     * @param string|null $episodeStatus
     * @param int|null $yearsId
     * @param int|null $regionId
     * @return int
     */
    public function count(
        string $title = null,
        string $status = null,
        string $episodeStatus = null,
        int $yearsId = null,
        int $regionId = null
    ) {
        try {
            $query = Anime::whereHas('years', function (Builder $builder) use ($yearsId) {
                if (!is_null($yearsId)) {
                    $builder->whereKey($yearsId);
                }
            })->whereHas('region', function (Builder $builder) use ($regionId) {
                if (!is_null($regionId)) {
                    $builder->whereKey($regionId);
                }
            });
            if (!is_null($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($episodeStatus)) {
                $query->where('episode_status', $episodeStatus);
            }
            $result = $query->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return Anime|null
     */
    public function create(array $attributes)
    {
        try {
            $result = Anime::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Anime $anime
     * @return int
     */
    public function delete(Anime $anime)
    {
        try {
            $result = $anime->delete();
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getOwner(int $id): ?Model
    {
        try {
            $result = Anime::find($id);
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
            $anime = Anime::query()
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
            $anime = Collection::make();
        }

        return $anime;
    }

    /**
     * @return Anime[]|Collection
     */
    public function limitTen()
    {
        try {
            $result = Anime::where('status', NYEnumConstants::YES)
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
     * @param int|null $regionId
     * @param array $genresIds
     * @param int|null $yearsId
     * @param null|string $episodeStatus
     * @param int|null $languageId
     * @param int $page
     * @param int $perpage
     * @param string $latestColumn
     * @return Collection|Anime[]
     */
    public function enableBook(
        ?int $regionId,
        array $genresIds,
        ?int $yearsId,
        ?string $episodeStatus,
        ?int $languageId,
        int $page,
        int $perpage,
        string $latestColumn
    ): Collection {
        try {
            $query = Anime::where('status', NYEnumConstants::YES)->latest($latestColumn)->forPage($page, $perpage)
                ->whereHas('region', function (Builder $query) use ($regionId) {
                    if (!is_null($regionId)) {
                        $query->whereKey($regionId);
                    }
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('years', function (Builder $query) use ($yearsId) {
                    if (!is_null($yearsId)) {
                        $query->whereKey($yearsId);
                    }
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('genres', function (Builder $query) use ($genresIds) {
                    if (ArrayMaster::isList($genresIds)) {
                        $query->whereKey($genresIds);
                    }
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('episodes', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES)->where('opening_time', '<=', Carbon::now());
                });
            if (!is_null($episodeStatus)) {
                $query->where('episode_status', $episodeStatus);
            }
            if (!is_null($languageId)) {
                $query->whereHas('language', function (Builder $query) use ($languageId) {
                    $query->whereKey($languageId)->where('status', NYEnumConstants::YES);
                });
            }
            $anime = $query->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $anime = Collection::make();
        }

        return $anime;
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
            $anime = Anime::where('title', 'like', '%' . $keyword . '%')
                ->where('status', NYEnumConstants::YES)
                ->whereHas('episodes', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES)
                        ->where('opening_time', '<=', Carbon::now())
                        ->whereHas('sources', function (Builder $query) {
                            $query->where('status', NYEnumConstants::YES);
                        });
                })->forPage($page, $perpage)->latest('views')->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $anime = Collection::make();
        }

        return $anime;
    }

    /**
     * @param int|null $regionId
     * @param array $genresIds
     * @param int|null $yearsId
     * @param null|string $episodeStatus
     * @return int
     */
    public function countEnable(
        ?int $regionId,
        array $genresIds,
        ?int $yearsId,
        ?string $episodeStatus
    ): int {
        try {
            $query = Anime::where('status', NYEnumConstants::YES)
                ->whereHas('region', function (Builder $query) use ($regionId) {
                    if (!is_null($regionId)) {
                        $query->whereKey($regionId);
                    }
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('years', function (Builder $query) use ($yearsId) {
                    if (!is_null($yearsId)) {
                        $query->whereKey($yearsId);
                    }
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('genres', function (Builder $query) use ($genresIds) {
                    if (ArrayMaster::isList($genresIds)) {
                        $query->whereKey($genresIds);
                    }
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('episodes', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES)->where('opening_time', '<=', Carbon::now());
                });
            if (!is_null($episodeStatus)) {
                $query->where('episode_status', $episodeStatus);
            }
            $count = $query->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $count = 0;
        }

        return $count;
    }

    /**
     * @param string $keyword
     * @return int
     */
    public function resultCount(string $keyword): int
    {
        try {
            $count = Anime::where('title', 'like', '%' . $keyword . '%')
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
     * @param int|null $regionId
     * @param array $genresIds
     * @param int|null $yearsId
     * @param null|string $episodeStatus
     * @param int $page
     * @param int $perpage
     * @param string $domain
     * @return Collection|Anime[]
     */
    public function mostCommented(
        ?int $regionId,
        array $genresIds,
        ?int $yearsId,
        ?string $episodeStatus,
        int $page,
        int $perpage,
        string $domain
    ) {
        try {
            $query = Anime::where('status', NYEnumConstants::YES)->forPage($page, $perpage)
                ->whereHas('region', function (Builder $query) use ($regionId) {
                    if (!is_null($regionId)) {
                        $query->whereKey($regionId);
                    }
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('years', function (Builder $query) use ($yearsId) {
                    if (!is_null($yearsId)) {
                        $query->whereKey($yearsId);
                    }
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('genres', function (Builder $query) use ($genresIds) {
                    if (ArrayMaster::isList($genresIds)) {
                        $query->whereKey($genresIds);
                    }
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('episodes', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES)->where('opening_time', '<=', Carbon::now());
                });
            if (!is_null($episodeStatus)) {
                $query->where('episode_status', $episodeStatus);
            }
            $anime = $query->latest('comments_count')->withCount([
                'comments' => function (Builder $query) use ($domain) {
                    $query->whereHas('branch', function (Builder $query) use ($domain) {
                        $query->where('status', NYEnumConstants::YES)->where('domain', $domain);
                    });
                }
            ])->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $anime = Collection::make();
        }

        return $anime;
    }

    /**
     * @param int $id
     * @return IClassifiedEntity|null
     */
    public function findEnable(int $id): ?IClassifiedEntity
    {
        try {
            $result = Anime::where('status', NYEnumConstants::YES)
                ->whereHas('episodes', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES)
                        ->where('opening_time', '<=', Carbon::now())
                        ->whereHas('sources');
                })->whereHas('region', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('years', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES);
                })->whereHas('genres', function (Builder $query) {
                    $query->where('status', NYEnumConstants::YES);
                })->find($id);
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
            $isFavorite = Anime::whereKey($id)->whereHas('collector', function (Builder $query) use ($memberId) {
                $query->whereKey($memberId);
            })->exists();
        } catch (\Throwable $e) {
            $isFavorite = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $isFavorite;
    }
}
