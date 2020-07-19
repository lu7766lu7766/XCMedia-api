<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/17
 * Time: 下午 05:40
 */

namespace Modules\Variety\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\IClassifiedEntity;
use Modules\Classified\Contracts\ILeaderBoardProvider;
use Modules\Classified\Contracts\ISearchEngine;
use Modules\Episode\Contracts\IEpisodeOwnerRepo;
use Modules\Member\Constants\MemberStatusConstants;
use Modules\Member\Contracts\ICommentProvider;
use Modules\Member\Contracts\IFavoriteProvider;
use Modules\Variety\Entities\Variety;

class VarietyRepo implements IEpisodeOwnerRepo, IFavoriteProvider, ICommentProvider, ILeaderBoardProvider, ISearchEngine
{
    /**
     * @param int $id
     * @return Variety|null
     */
    public function find(int $id)
    {
        try {
            $result = Variety::find($id);
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
     * @return Variety[]|Collection
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
            $query = Variety::whereHas('years', function (Builder $builder) use ($yearsId) {
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
            $query = Variety::whereHas('years', function (Builder $builder) use ($yearsId) {
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
     * @return Variety|null
     */
    public function create(array $attributes)
    {
        try {
            $result = Variety::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Variety $variety
     * @return bool
     */
    public function delete(Variety $variety)
    {
        try {
            $result = $variety->delete();
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
            $result = Variety::find($id);
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
            $varieties = Variety::query()
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
            $varieties = Collection::make();
        }

        return $varieties;
    }

    /**
     * @return Variety[]|Collection
     */
    public function limitTen()
    {
        try {
            $result = Variety::where('status', NYEnumConstants::YES)
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
            $varieties = Variety::where('title', 'like', '%' . $keyword . '%')
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
            $varieties = Collection::make();
        }

        return $varieties;
    }

    /**
     * @param string $keyword
     * @return int
     */
    public function resultCount(string $keyword): int
    {
        try {
            $count = Variety::where('title', 'like', '%' . $keyword . '%')
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
            $result = Variety::where('status', NYEnumConstants::YES)->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $genresId
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @param string|null $episodeStatus
     * @param int $page
     * @param int $perpage
     * @return Variety[]|Collection
     */
    public function latestList(
        int $genresId = null,
        int $regionId = null,
        int $yearsId = null,
        int $languageId = null,
        string $episodeStatus = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $result = $this->getQuery(
                $genresId,
                $regionId,
                $yearsId,
                $languageId,
                $episodeStatus
            )->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $genresId
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @param string|null $episodeStatus
     * @param int $page
     * @param int $perpage
     * @return Variety[]|Collection
     */
    public function popularList(
        int $genresId = null,
        int $regionId = null,
        int $yearsId = null,
        int $languageId = null,
        string $episodeStatus = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $result = $this->getQuery(
                $genresId,
                $regionId,
                $yearsId,
                $languageId,
                $episodeStatus
            )->orderByDesc('views')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $domain
     * @param int|null $genresId
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @param string|null $episodeStatus
     * @param int $page
     * @param int $perpage
     * @return Variety[]|Collection
     */
    public function mostCommentList(
        string $domain,
        int $genresId = null,
        int $regionId = null,
        int $yearsId = null,
        int $languageId = null,
        string $episodeStatus = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $result = $this->getQuery(
                $genresId,
                $regionId,
                $yearsId,
                $languageId,
                $episodeStatus
            )->withCount([
                'comments' => function (Builder $query) use ($domain) {
                    $query->whereHas('branch', function (Builder $query) use ($domain) {
                        $query->where('domain', $domain)
                            ->where('status', NYEnumConstants::YES);
                    });
                }
            ])->orderByDesc('comments_count')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $genresId
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @param string|null $episodeStatus
     * @return int
     */
    public function total(
        int $genresId = null,
        int $regionId = null,
        int $yearsId = null,
        int $languageId = null,
        string $episodeStatus = null
    ) {
        try {
            $result = $this->getQuery($genresId, $regionId, $yearsId, $languageId, $episodeStatus)->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return Variety|null
     */
    public function info(int $id)
    {
        try {
            $result = Variety::with([
                'region',
                'years',
                'language',
                'genres'
            ])
                ->where('status', NYEnumConstants::YES)
                ->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string $domain
     * @param int $page
     * @param int $perpage
     * @return Variety|Model|null
     */
    public function getComments(
        int $id,
        string $domain,
        int $page = 1,
        int $perpage = 10
    ) {
        try {
            $result = Variety::with([
                'comments' => function (MorphToMany $builder) use ($domain, $page, $perpage) {
                    $builder->whereHas('branch', function (Builder $builder) use ($domain) {
                        $builder->where('branch.domain', $domain)
                            ->where('branch.status', NYEnumConstants::YES);
                    })
                        ->where('member.status', MemberStatusConstants::ENABLE)
                        ->orderByDesc('member_comment.created_at')
                        ->forPage($page, $perpage);
                }
            ])->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string $domain
     * @return int
     */
    public function countComments(
        int $id,
        string $domain
    ) {
        try {
            $variety = Variety::query()->withCount([
                'comments' => function (Builder $builder) use ($domain) {
                    $builder->whereHas('branch', function (Builder $builder) use ($domain) {
                        $builder->where('branch.domain', $domain)
                            ->where('branch.status', NYEnumConstants::YES);
                    });
                }
            ])->find($id);
            $result = is_null($variety) ? 0 : $variety->getAttribute('comments_count');
        } catch (\Throwable $e) {
            $result = 0;
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
            $result = Variety::whereKey($id)
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

    /**
     * @param int|null $genresId
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @param string|null $episodeStatus
     * @return Builder
     */
    private function getQuery(
        int $genresId = null,
        int $regionId = null,
        int $yearsId = null,
        int $languageId = null,
        string $episodeStatus = null
    ) {
        $query = Variety::where('status', NYEnumConstants::YES)
            ->with([
                'episodes' => function (MorphMany $builder) {
                    $builder->where('episode.status', NYEnumConstants::YES)
                        ->where('opening_time', '<=', Carbon::now());
                }
            ])
            ->whereHas('genres', function (Builder $builder) use ($genresId) {
                if (!is_null($genresId)) {
                    $builder->whereKey($genresId);
                }
            })
            ->whereHas('years', function (Builder $builder) use ($yearsId) {
                if (!is_null($yearsId)) {
                    $builder->whereKey($yearsId);
                }
            })
            ->whereHas('region', function (Builder $builder) use ($regionId) {
                if (!is_null($regionId)) {
                    $builder->whereKey($regionId);
                }
            })->whereHas('episodes', function (Builder $query) {
                $query->where('status', NYEnumConstants::YES)
                    ->where('opening_time', '<=', Carbon::now());
            });
        if (!is_null($episodeStatus)) {
            $query->where('episode_status', $episodeStatus);
        }
        if (!is_null($languageId)) {
            $query->whereHas('language', function (Builder $builder) use ($languageId) {
                $builder->whereKey($languageId);
            });
        }

        return $query;
    }
}
