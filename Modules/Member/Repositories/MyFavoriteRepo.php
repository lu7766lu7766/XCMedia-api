<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/5
 * Time: 下午 08:02
 */

namespace Modules\Member\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Constants\ClassifiedMorphMapConstants;
use Modules\Member\Entities\Member;

class MyFavoriteRepo
{
    /**
     * @param Member $member
     * @param string|null $type
     * @param int $page
     * @param int $perpage
     * @return Collection|\Modules\Member\Entities\MyFavorite[]
     */
    public function list(Member $member, string $type = null, int $page = 1, $perpage = 20)
    {
        try {
            /** @var Member $result */
            $result = $member->load([
                'myFavorite' => function (Relation $query) use ($type, $page, $perpage) {
                    if (!is_null($type)) {
                        $query->where('media_type', $type);
                    }
                    $query->whereHasMorph('media', '*', function (Builder $builder) {
                        $builder->where('status', NYEnumConstants::YES);
                    })->with('media')->forPage($page, $perpage);
                }
            ]);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = collect();
        }

        return $result->myFavorite ?? $result;
    }

    /**
     * @param Member $member
     * @param string|null $type
     * @return int
     */
    public function total(Member $member, string $type = null)
    {
        try {
            $result = $member->loadCount([
                'myFavorite' => function (Builder $query) use ($type) {
                    if (!is_null($type)) {
                        $query->where('media_type', $type);
                    }
                    $query->whereHasMorph('media', '*', function (Builder $builder) {
                        $builder->where('status', NYEnumConstants::YES);
                    });
                }
            ]);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = 0;
        }

        return $result->my_favorite_count ?? $result;
    }

    /**
     * @param Member $member
     * @param int $id
     * @return int
     */
    public function delete(Member $member, int $id)
    {
        try {
            $result = $member->myFavorite()->whereKey($id)->delete();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = 0;
        }

        return $result;
    }

    /**
     * @param Member $member
     * @param string|null $mediaType
     * @return int
     */
    public function deleteAll(Member $member, string $mediaType = null)
    {
        try {
            $myFavorite = $member->myFavorite();
            if (!is_null($mediaType)) {
                $myFavorite->where('media_type', $mediaType);
            }
            $result = $myFavorite->delete();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = 0;
        }

        return $result;
    }

    /**
     * @param Member $member
     * @param string $type
     * @param int $mediaId
     * @return Member|null
     */
    public function isMyFavorite(Member $member, string $type, int $mediaId)
    {
        try {
            $result = $member->load([
                'myFavorite' => function (Relation $query) use ($type, $mediaId) {
                    $query->whereHasMorph('media', ClassifiedMorphMapConstants::map($type),
                        function (Builder $builder) use ($mediaId) {
                            $builder->where('status', NYEnumConstants::YES)->whereKey($mediaId);
                        })->with('media');
                }
            ]);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = null;
        }

        return $result;
    }
}
