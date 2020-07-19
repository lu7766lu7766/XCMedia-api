<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 05:03
 */

namespace Modules\Movie\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Modules\Classified\Http\Requests\Client\LeaderBoardIndexRequest;
use Modules\Classified\Service\LeaderBoardService;
use Modules\Movie\Repositories\MovieRepo;

class LeaderBoardController extends Controller
{
    /** @var LeaderBoardService $service */
    private $service;

    /**
     * LeaderBoardController constructor.
     */
    public function __construct()
    {
        $this->service = app(LeaderBoardService::class, ['repo' => app(MovieRepo::class)]);
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
