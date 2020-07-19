<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/25
 * Time: 下午 02:27
 */

namespace Modules\Layout\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Modules\Layout\Entities\Layout;
use Modules\Layout\Services\LayoutService;

class LayoutController extends Controller
{
    /** @var LayoutService $service */
    private $service;

    /**
     * LayoutController constructor.
     * @param LayoutService $service
     */
    public function __construct(LayoutService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Collection|Layout[]
     */
    public function index()
    {
        return $this->service->list();
    }
}
