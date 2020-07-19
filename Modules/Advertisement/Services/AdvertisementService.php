<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/19
 * Time: 下午 03:41
 */

namespace Modules\Advertisement\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Advertisement\Entities\Advertisement;
use Modules\Advertisement\Entities\AdvertisementType;
use Modules\Advertisement\Http\Requests\Client\InfoRequest;
use Modules\Advertisement\Repositories\BranchAdvertisementRepo;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use XC\Independent\Kit\Utils\UrlParserUtil;

class AdvertisementService
{
    /** @var BranchAdvertisementRepo $repo */
    private $repo;
    /** @var UrlParserUtil $url */
    private $url;

    /**
     * AdvertisementService constructor.
     * @param BranchAdvertisementRepo $repo
     * @param UrlParserUtil $url
     */
    public function __construct(BranchAdvertisementRepo $repo, UrlParserUtil $url)
    {
        $this->repo = $repo;
        $this->url = $url;
    }

    /**
     * @return AdvertisementType[]|Collection
     */
    public function list()
    {
        $host = $this->url->host();

        return $this->repo->getEnableByDomain($host)->load(
            [
                'advertisement' => function (HasMany $query) use ($host) {
                    $query->where('status', NYEnumConstants::YES)
                        ->whereHas('owner', function (Builder $query) use ($host) {
                            $query->where('domain', $host);
                        });
                }
            ]
        );
    }

    /**
     * @param InfoRequest $request
     * @return Advertisement
     * @throws ApiErrorCodeException
     */
    public function info(InfoRequest $request)
    {
        $advertisement = $this->repo->findEnable($request->getId(), $this->url->host());
        if (is_null($advertisement)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        try {
            $advertisement->increment('hits');
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw  new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $advertisement;
    }
}
