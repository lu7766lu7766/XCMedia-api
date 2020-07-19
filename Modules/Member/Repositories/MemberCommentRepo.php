<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/10
 * Time: 下午 05:37
 */

namespace Modules\Member\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Anime\Entities\Anime;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Member\Constants\MemberStatusConstants;
use Modules\Member\Contracts\ICommentEntity;
use Modules\Member\Pivots\MemberCommentPivot;
use Modules\Member\Entities\MemberComment;

class MemberCommentRepo
{
    /**
     * @param ICommentEntity $model
     * @param int $memberId
     * @param string $contents
     * @return bool
     */
    public function add(ICommentEntity $model, int $memberId, string $contents)
    {
        $result = true;
        try {
            $model->comments()->attach($memberId, ['contents' => $contents]);
        } catch (\Throwable $e) {
            $result = false;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $domain
     * @param int $animeId
     * @param int $page
     * @param int $perpage
     * @return MemberCommentPivot[]|Collection
     */
    public function animeEnableBook(string $domain, int $animeId, int $page, int $perpage)
    {
        try {
            $comments = MemberCommentPivot::whereHas('member', function (Builder $query) use ($domain) {
                $query->whereHas('branch', function (Builder $query) use ($domain) {
                    $query->where('domain', $domain)->where('status', NYEnumConstants::YES);
                });
            })->whereHasMorph('commentAble', Anime::class, function (Builder $query) use ($animeId) {
                $query->whereKey($animeId);
            })->forPage($page, $perpage)->latest()->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $comments = Collection::make();
        }

        return $comments;
    }

    /**
     * @param string $domain
     * @param int $animeId
     * @return int
     */
    public function countAnimeEnable(string $domain, int $animeId)
    {
        try {
            $count = MemberCommentPivot::whereHas('member', function (Builder $query) use ($domain) {
                $query->whereHas('branch', function (Builder $query) use ($domain) {
                    $query->where('domain', $domain)->where('status', NYEnumConstants::YES);
                });
            })->whereHasMorph('commentAble', Anime::class, function (Builder $query) use ($animeId) {
                $query->whereKey($animeId);
            })->count();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $count = 0;
        }

        return $count;
    }

    /**
     * @param int $mediaId
     * @param string $classified
     * @param string $host
     * @param int $page
     * @param int $perpage
     * @return MemberComment[]|Collection
     */
    public function list(int $mediaId, string $classified, string $host, int $page = 1, int $perpage = 20)
    {
        try {
            $result = MemberComment::query()
                ->wherehas('member', function (Builder $builder) use ($host) {
                    $builder->whereHas('branch', function (Builder $b) use ($host) {
                        $b->where('domain', $host)->where('status', NYEnumConstants::YES);
                    })->where('status', MemberStatusConstants::ENABLE);
                })->whereHasMorph('media', $classified, function (Builder $builder) use ($mediaId) {
                    $builder->whereKey($mediaId);
                })
                ->with('member')
                ->forPage($page, $perpage)
                ->orderByDesc('created_at')
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $mediaId
     * @param string $classified
     * @param string $host
     * @return int
     */
    public function count(int $mediaId, string $classified, string $host)
    {
        try {
            $result = MemberComment::query()
                ->wherehas('member', function (Builder $builder) use ($host) {
                    $builder->whereHas('branch', function (Builder $b) use ($host) {
                        $b->where('domain', $host)->where('status', NYEnumConstants::YES);
                    })->where('status', MemberStatusConstants::ENABLE);
                })->whereHasMorph('media', $classified, function (Builder $builder) use ($mediaId) {
                    $builder->where('commented_id', $mediaId);
                })
                ->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
