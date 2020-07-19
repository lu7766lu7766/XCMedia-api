<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/19
 * Time: 下午 05:09
 */

namespace Modules\Advertisement\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Advertisement\Entities\Advertisement;
use Modules\Advertisement\Entities\AdvertisementType;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;

class BranchAdvertisementRepo
{
    /**
     * @param string $domain
     * @return AdvertisementType[]|Collection
     */
    public function getEnableByDomain(string $domain)
    {
        try {
            $ads = AdvertisementType::whereHas('advertisement', function (Builder $query) use ($domain) {
                $query->where('status', NYEnumConstants::YES)
                    ->whereHas('owner', function (Builder $query) use ($domain) {
                        $query->where('domain', $domain);
                    });
            })->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $ads = Collection::make();
        }

        return $ads;
    }

    /**
     * @param int $id
     * @param string $domain
     * @return Advertisement|null
     */
    public function findEnable(int $id, string $domain)
    {
        try {
            $ad = Advertisement::whereKey($id)
                ->where('status', NYEnumConstants::YES)
                ->whereHas('owner', function (Builder $query) use ($domain) {
                    $query->where('domain', $domain);
                })->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $ad = null;
        }

        return $ad;
    }
}
