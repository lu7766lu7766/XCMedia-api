<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/19
 * Time: 下午 03:46
 */

namespace Modules\FAQ\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\FAQ\Entities\FAQ;
use Modules\FAQ\Http\Requests\ClientListRequestHandle;
use Modules\FAQ\Services\ClientFAQService;

class ClientFAQController extends Controller
{
    /** @var ClientFAQService $service */
    private $service;

    public function __construct()
    {
        $this->service = app(ClientFAQService::class);
    }

    /**
     * @param ClientListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|FAQ[]
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function index(ClientListRequestHandle $request)
    {
        return $this->service->get($request);
    }

    /**
     * @return int
     */
    public function total()
    {
        return $this->service->total();
    }
}
