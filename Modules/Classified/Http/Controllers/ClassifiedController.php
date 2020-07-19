<?php

namespace Modules\Classified\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Http\Requests\ClassifiedSearchRequest;
use Modules\Classified\Http\Requests\ClassifiedSearchTotalRequest;
use Modules\Classified\Service\ClassifiedService;

class ClassifiedController extends Controller
{
    /** @var ClassifiedService $service */
    private $service;

    /**
     * ClassifiedController constructor.
     * @param ClassifiedService $service
     */
    public function __construct(ClassifiedService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ClassifiedSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function search(ClassifiedSearchRequest $request)
    {
        return $this->service->search($request);
    }

    /**
     * @param ClassifiedSearchTotalRequest $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function searchCount(ClassifiedSearchTotalRequest $request)
    {
        return $this->service->searchTotal($request);
    }

    /**
     * @return array
     */
    public function type()
    {
        return [
            ClassifiedConstant::DRAMA,
            ClassifiedConstant::MOVIE,
            ClassifiedConstant::ANIME,
            ClassifiedConstant::VARIETY
        ];
    }
}
