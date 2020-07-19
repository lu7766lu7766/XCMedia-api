<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/3/16
 * Time: 下午 03:41
 */

namespace Modules\Movie\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Member\Constants\MemberStatusConstants;
use Modules\Movie\Entities\Movie;

class ClientMovieRepo
{
    /**
     * 最新電影列表
     * @param int|null $regionId
     * @param int|null $genresId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @param int $page
     * @param int $perpage
     * @return Collection|Movie[]
     */
    public function latestList(
        int $regionId = null,
        int $genresId = null,
        int $yearsId = null,
        int $languageId = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $result = $this->getSQLQuery($regionId, $genresId, $yearsId, $languageId)
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
     * 最多人觀看電影列表
     * @param int|null $regionId
     * @param int|null $genresId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @param int $page
     * @param int $perpage
     * @return Collection|Movie[]
     */
    public function popularList(
        int $regionId = null,
        int $genresId = null,
        int $yearsId = null,
        int $languageId = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $result = $this->getSQLQuery($regionId, $genresId, $yearsId, $languageId)
                ->orderByDesc('views')
                ->forPage($page, $perpage)
                ->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * 最多評論電影列表
     * @param int|null $regionId
     * @param int|null $genresId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @param string|null $domain
     * @param int $page
     * @param int $perpage
     * @return Collection|Movie[]
     */
    public function hotTopicList(
        int $regionId = null,
        int $genresId = null,
        int $yearsId = null,
        int $languageId = null,
        string $domain = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $result = $this->getSQLQuery($regionId, $genresId, $yearsId, $languageId)
                ->withCount([
                    'comments' => function (Builder $builder) use ($domain) {
                        $builder->whereHas('branch', function (Builder $builder) use ($domain) {
                            $builder->where('branch.domain', $domain)
                                ->where('branch.status', NYEnumConstants::YES);
                        })
                            ->where('member.status', MemberStatusConstants::ENABLE);
                    }
                ])
                ->orderByDesc('comments_count')
                ->forPage($page, $perpage)
                ->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * 列表總數
     * @param int|null $regionId
     * @param int|null $genresId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @return int
     */
    public function total(
        int $regionId = null,
        int $genresId = null,
        int $yearsId = null,
        int $languageId = null
    ) {
        try {
            $result = $this->getSQLQuery($regionId, $genresId, $yearsId, $languageId)->count();
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
    public function info(int $id)
    {
        try {
            $result = $this->getSQLQuery()
                ->with([
                    'region',
                    'years',
                    'language',
                    'genres'
                ])
                ->whereKey($id)
                ->first();
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
     * @return Movie|null
     */
    public function commentsList(int $id, string $domain, int $page = 1, int $perpage = 10)
    {
        try {
            $result = $this->getSQLQuery()
                ->with([
                    'comments' => function (MorphToMany $builder) use ($domain, $page, $perpage) {
                        $builder->whereHas('branch', function (Builder $builder) use ($domain) {
                            $builder->where('branch.domain', $domain)
                                ->where('branch.status', NYEnumConstants::YES);
                        })
                            ->select(['member.id', 'member.account'])
                            ->where('member.status', MemberStatusConstants::ENABLE)
                            ->orderByDesc('member_comment.created_at')
                            ->forPage($page, $perpage);
                    }
                ])
                ->whereKey($id)
                ->first();
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
    public function commentsTotal(int $id, string $domain)
    {
        $result = 0;
        try {
            $movie = $this->getSQLQuery()
                ->withCount([
                    'comments' => function (Builder $builder) use ($domain) {
                        $builder->whereHas('branch', function (Builder $builder) use ($domain) {
                            $builder->where('branch.domain', $domain)
                                ->where('branch.status', NYEnumConstants::YES);
                        })
                            ->where('member.status', MemberStatusConstants::ENABLE);
                    }
                ])
                ->whereKey($id)
                ->first();
            if (!is_null($movie)) {
                $result = $movie->getAttribute('comments_count');
            }
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $regionId
     * @param int|null $genresId
     * @param int|null $yearsId
     * @param int|null $languageId
     * @return Builder
     */
    private function getSQLQuery(
        int $regionId = null,
        int $genresId = null,
        int $yearsId = null,
        int $languageId = null
    ) {
        $query = Movie::where('status', NYEnumConstants::YES);
        if (!is_null($languageId)) {
            $query->whereHas('language', function (Builder $builder) use ($languageId) {
                $builder->where('language.used_type', ClassifiedConstant::MOVIE);
                if (!is_null($languageId)) {
                    $builder->whereKey($languageId);
                }
            });
        }

        return $query->whereHas('region', function (Builder $builder) use ($regionId) {
            $builder->where('region.used_type', ClassifiedConstant::MOVIE);
            if (!is_null($regionId)) {
                $builder->whereKey($regionId);
            }
        })->whereHas('years', function (Builder $builder) use ($yearsId) {
            $builder->where('years.used_type', ClassifiedConstant::MOVIE);
            if (!is_null($yearsId)) {
                $builder->whereKey($yearsId);
            }
        })->whereHas('genres', function (Builder $builder) use ($genresId) {
            $builder->where('genres.used_type', ClassifiedConstant::MOVIE);
            if (!is_null($genresId)) {
                $builder->whereKey($genresId);
            }
        })->whereHas('episodes', function (Builder $builder) {
            $builder->where('episode.status', NYEnumConstants::YES)
                ->where('episode.opening_time', '<=', Carbon::now()->toDateTimeString());
        });
    }
}
