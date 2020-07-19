<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/9
 * Time: 下午 04:01
 */

namespace Modules\Advertisement\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Advertisement\Entities\Advertisement;
use Modules\Advertisement\Entities\AdvertisementType;
use Modules\Base\Util\LaravelLoggerUtil;

class AdvertisementRepo
{
    /**
     * @param int $id
     * @return Advertisement|null
     */
    public function find(int $id)
    {
        try {
            $result = Advertisement::find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $type
     * @param string|null $status
     * @param string|null $title
     * @param int $page
     * @param int $perpage
     * @return Advertisement[]|Collection
     */
    public function get(
        int $type = null,
        string $status = null,
        string $title = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Advertisement::query()
                ->whereHas('type', function (Builder $query) use ($type) {
                    if (!is_null($type)) {
                        $query->whereKey($type);
                    }
                })
                ->whereHas('branches')
                ->with(['type', 'branches']);
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }
            $result = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int|null $type
     * @param string|null $status
     * @param string|null $title
     * @return int
     */
    public function count(
        int $type = null,
        string $status = null,
        string $title = null
    ) {
        try {
            $query = Advertisement::query()
                ->whereHas('type', function (Builder $query) use ($type) {
                    if (!is_null($type)) {
                        $query->whereKey($type);
                    }
                })->whereHas('branches');
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            if (!is_null($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }
            $result = $query->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param AdvertisementType $type
     * @param array $attributes
     * @param Collection $branches
     * @return Advertisement|null
     */
    public function create(AdvertisementType $type, array $attributes, Collection $branches)
    {
        $result = null;
        try {
            \DB::transaction(function () use ($attributes, $branches, $type, &$result) {
                $advertisement = new Advertisement($attributes);
                $result = $type->advertisement()->save($advertisement);
                $advertisement->publishBranches($branches);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param AdvertisementType $type
     * @param Advertisement $advertisement
     * @param array $attributes
     * @param Collection $branches
     * @return Advertisement|null
     */
    public function update(
        AdvertisementType $type,
        Advertisement $advertisement,
        array $attributes,
        Collection $branches
    ) {
        $result = null;
        try {
            \DB::transaction(function () use ($attributes, $branches, $advertisement, $type, &$result) {
                $advertisement->fill($attributes)->type()->associate($type)->save();
                $advertisement->publishBranches($branches);
                $result = $advertisement;
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Advertisement $advertisement
     * @return int
     */
    public function delete(Advertisement $advertisement)
    {
        try {
            \DB::transaction(function () use ($advertisement, &$result) {
                $result = Advertisement::where('id', $advertisement->getKey())->delete();
                $advertisement->cancelBranches();
            });
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
