<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 06:05
 */

namespace Modules\Classified\Service;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Factories\ClassifiedSearchEngineFactory;
use Modules\Classified\Http\Requests\ClassifiedSearchRequest;
use Modules\Classified\Http\Requests\ClassifiedSearchTotalRequest;

class ClassifiedService
{
    /**
     * @param ClassifiedSearchRequest $request
     * @return Collection|Model[]
     * @throws ApiErrorCodeException
     */
    public function search(ClassifiedSearchRequest $request)
    {
        $engine = ClassifiedSearchEngineFactory::make($request->getType());
        if (is_null($engine)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'ENGINE NOT FOUND');
        }

        return $engine->resultsPages(
            $request->getKeyword(),
            $request->getPage(),
            $request->getPerpage())
            ->load(([
                'episodes' => function (Relation $query) {
                    $query->where('status', NYEnumConstants::YES)->where('opening_time', '<=', Carbon::now());
                }
            ]));
    }

    /**
     * @param ClassifiedSearchTotalRequest $request
     * @return int
     * @throws ApiErrorCodeException
     */
    public function searchTotal(ClassifiedSearchTotalRequest $request)
    {
        $engine = ClassifiedSearchEngineFactory::make($request->getType());
        if (is_null($engine)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'ENGINE NOT FOUND');
        }

        return $engine->resultCount($request->getKeyword());
    }
}
