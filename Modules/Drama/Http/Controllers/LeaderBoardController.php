<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 04:07
 */

namespace Modules\Drama\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Modules\Classified\Http\Requests\Client\LeaderBoardIndexRequest;
use Modules\Classified\Service\LeaderBoardService;
use Modules\Drama\Repositories\DramaRepo;

class LeaderBoardController extends Controller
{
    /** @var LeaderBoardService $service */
    private $service;

    /**
     * LeaderBoardController constructor.
     */
    public function __construct()
    {
        $this->service = app(LeaderBoardService::class, ['repo' => app(DramaRepo::class)]);
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
