<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/10
 * Time: 下午 06:53
 */

namespace Modules\Drama\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Constants\ClientListSortConstants;
use Modules\Classified\Contracts\IClassifiedEntity;
use Modules\Classified\Contracts\ILeaderBoardProvider;
use Modules\Classified\Contracts\ISearchEngine;
use Modules\Drama\Entities\Drama;
use Modules\Episode\Contracts\IEpisodeOwnerRepo;
use Modules\Member\Constants\MemberStatusConstants;
use Modules\Member\Contracts\ICommentProvider;
use Modules\Member\Contracts\IFavoriteProvider;

class DramaRepo implements IEpisodeOwnerRepo, IFavoriteProvider, ICommentProvider, ILeaderBoardProvider, ISearchEngine
{
    /**
     * @param int $id
     * @return Drama|null
     */
    public function find(int $id)
    {
        try {
            $result = Drama::find($id);
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
     * @return Drama[]|Collection
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
            $query = Drama::whereHas('years', function (Builder $builder) use ($yearsId) {
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
            $query = Drama::whereHas('years', function (Builder $builder) use ($yearsId) {
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
     * @return Drama|null
     */
    public function create(array $attributes)
    {
        try {
            $result = Drama::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Drama $drama
     * @return bool
     */
    public function delete(Drama $drama)
    {
        try {
            $result = $drama->delete();
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
            $result = Drama::find($id);
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
            $dramas = Drama::query()
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
            $dramas = Collection::make();
        }

        return $dramas;
    }

    /**
     * @return Drama[]|Collection
     */
    public function limitTen()
    {
        try {
            $result = Drama::where('status', NYEnumConstants::YES)
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
            $dramas = Drama::where('title', 'like', '%' . $keyword . '%')
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
            $dramas = Collection::make();
        }

        return $dramas;
    }

    /**
     * @param string $keyword
     * @return int
     */
    public function resultCount(string $keyword): int
    {
        try {
            $count = Drama::where('title', 'like', '%' . $keyword . '%')
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
            $result = Drama::where('status', NYEnumConstants::YES)->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $host
     * @param string $sort
     * @param string|null $episodeStatus
     * @param int|null $languageId
     * @param int|null $yearsId
     * @param int|null $regionId
     * @param int|null $genresId
     * @param int $page
     * @param int $perpage
     * @return Drama[]|Collection
     */
    public function getClientList(
        string $host,
        string $sort = ClientListSortConstants::HOT,
        string $episodeStatus = null,
        int $languageId = null,
        int $yearsId = null,
        int $regionId = null,
        int $genresId = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = $this->clientListQuery($episodeStatus, $languageId, $yearsId, $regionId, $genresId);
            if ($sort == ClientListSortConstants::COMMENT) {
                $query->withCount([
                    'comments' => function (Builder $builder) use ($host) {
                        $builder->whereHas('branch', function (Builder $b) use ($host) {
                            $b->where('status', NYEnumConstants::YES)->where('domain', $host);
                        })->where('status', MemberStatusConstants::ENABLE);
                    }
                ]);
            }
            $result = $query->with([
                'episodes' => function (MorphMany $builder) {
                    $builder->where('episode.status', NYEnumConstants::YES)
                        ->where('opening_time', '<=', Carbon::now());
                }
            ])->orderByDesc($this->sortMap($sort))
                ->forPage($page, $perpage)
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $episodeStatus
     * @param int|null $languageId
     * @param int|null $yearsId
     * @param int|null $regionId
     * @param int|null $genresId
     * @return int
     */
    public function getClientListCount(
        string $episodeStatus = null,
        int $languageId = null,
        int $yearsId = null,
        int $regionId = null,
        int $genresId = null
    ) {
        try {
            $result = $this->clientListQuery($episodeStatus, $languageId, $yearsId, $regionId, $genresId)->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return Drama|null
     */
    public function findClientEnable(int $id)
    {
        try {
            $result = Drama::where('status', NYEnumConstants::YES)
                ->with(['years', 'region', 'genres'])->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $sort
     * @return string
     */
    private function sortMap(string $sort)
    {
        $sortMap = [
            ClientListSortConstants::HOT     => 'views',
            ClientListSortConstants::COMMENT => 'comments_count',
            ClientListSortConstants::NEW     => 'id',
        ];

        return $sortMap[$sort];
    }

    /**
     * @param string|null $episodeStatus
     * @param int|null $languageId
     * @param int|null $yearsId
     * @param int|null $regionId
     * @param int|null $genresId
     * @return Builder
     */
    private function clientListQuery(
        string $episodeStatus = null,
        int $languageId = null,
        int $yearsId = null,
        int $regionId = null,
        int $genresId = null
    ) {
        $query = Drama::whereHas('years', function (Builder $builder) use ($yearsId) {
            $builder->where('used_type', ClassifiedConstant::DRAMA);
            if (!is_null($yearsId)) {
                $builder->whereKey($yearsId);
            }
        })->whereHas('region', function (Builder $builder) use ($regionId) {
            $builder->where('used_type', ClassifiedConstant::DRAMA);
            if (!is_null($regionId)) {
                $builder->whereKey($regionId);
            }
        })->wherehas('genres', function (Builder $builder) use ($genresId) {
            $builder->where('used_type', ClassifiedConstant::DRAMA);
            if (!is_null($genresId)) {
                $builder->whereKey($genresId);
            }
        })->whereHas('episodes', function (Builder $builder) {
            $builder->where('episode.status', NYEnumConstants::YES)
                ->where('episode.opening_time', '<=', Carbon::now()->toDateTimeString());
        })
            ->where('status', NYEnumConstants::YES);
        if (!is_null($episodeStatus)) {
            $query->where('episode_status', $episodeStatus);
        }
        if (!is_null($languageId)) {
            $query->whereHas('language', function (Builder $builder) use ($languageId) {
                $builder->whereKey($languageId)->where('used_type', ClassifiedConstant::DRAMA);
            });
        }

        return $query;
    }
}
