<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 05:27
 */

namespace Modules\Variety\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Modules\Classified\Http\Requests\Client\LeaderBoardIndexRequest;
use Modules\Classified\Service\LeaderBoardService;

class LeaderBoardController extends Controller
{
    /** @var LeaderBoardService $service */
    private $service;

    /**
     * LeaderBoardController constructor.
     * @param LeaderBoardService $service
     */
    public function __construct(LeaderBoardService $service)
    {
        $this->service = $service;
    }

    /**
     * @param LeaderBoardIndexRequest $request
     * @return Collection|Model[]
     */
    public function index(LeaderBoardIndexRequest $request): Collection
    {
        return $this->service->list($request);
    }
}
