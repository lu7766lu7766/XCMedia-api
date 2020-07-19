<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/5
 * Time: 下午 07:12
 */

namespace Modules\Member\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Episode\Entities\Episode;
use Modules\Member\Pivots\MemberViewedPivot;

class MemberViewedRepo
{
    /**
     * @param int $page
     * @param int $perpage
     * @param int $memberId
     * @param null|string $episodeMorphType
     * @return MemberViewedPivot[]|Collection
     */
    public function episodeEnableBook(int $page, int $perpage, int $memberId, ?string $episodeMorphType)
    {
        try {
            $views = MemberViewedPivot::query()
                ->whereHas('member', function (Builder $query) use ($memberId) {
                    $query->whereKey($memberId);
                })->whereHasMorph(
                    'readAble',
                    Episode::class,
                    function (Builder $query) use ($episodeMorphType) {
                        $query->where('status', NYEnumConstants::YES)
                            ->whereHasMorph('series', $episodeMorphType, function (Builder $query) {
                                $query->where('status', NYEnumConstants::YES);
                            })->whereHas('sources', function (Builder $query) {
                                $query->where('status', NYEnumConstants::YES);
                            });
                    }
                )->forPage($page, $perpage)->orderByDesc('updated_at')->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $views = Collection::make();
        }

        return $views;
    }

    /**
     * @param int $memberId
     * @param null|string $episodeMorphType
     * @return int
     */
    public function countEpisode(int $memberId, ?string $episodeMorphType): int
    {
        try {
            $count = MemberViewedPivot::query()
                ->whereHas('member', function (Builder $query) use ($memberId) {
                    $query->whereKey($memberId);
                })->whereHasMorph(
                    'readAble',
                    Episode::class,
                    function (Builder $query) use ($episodeMorphType) {
                        $query->where('status', NYEnumConstants::YES)
                            ->whereHasMorph('series', $episodeMorphType, function (Builder $query) {
                                $query->where('status', NYEnumConstants::YES);
                            })->whereHas('sources', function (Builder $query) {
                                $query->where('status', NYEnumConstants::YES);
                            });
                    }
                )->count();
        } catch (\Throwable $e) {
            $count = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $count;
    }

    /**
     * @param int $memberId
     * @param int $id
     * @param null|string $episodeMorphType
     * @return int
     */
    public function deleteEpisode(int $memberId, ?int $id, ?string $episodeMorphType)
    {
        try {
            $query = MemberViewedPivot::query()
                ->whereHas('member', function (Builder $query) use ($memberId) {
                    $query->whereKey($memberId);
                })->whereHasMorph(
                    'readAble',
                    Episode::class,
                    function (Builder $query) use ($episodeMorphType) {
                        $query->whereHasMorph('series', $episodeMorphType);
                    }
                );
            if (!is_null($id)) {
                $query->whereKey($id);
            }
            $count = $query->delete();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $count = 0;
        }

        return $count;
    }
}
