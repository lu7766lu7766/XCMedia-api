<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/1/31
 * Time: 上午 10:45
 */

namespace Modules\Anime\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\Genres;
use Modules\Classified\Http\Requests\Genres\GetIdRequestHandle;
use Modules\Classified\Http\Requests\Genres\ListRequestHandle;
use Modules\Classified\Http\Requests\Genres\StoreRequestHandle;
use Modules\Classified\Http\Requests\Genres\UpdateRequestHandle;
use Modules\Classified\Service\GenresSettingService;

class GenresSettingController extends Controller
{
    /** @var GenresSettingService $service */
    private $service;

    /**
     * GenresSettingController constructor.
     */
    public function __construct()
    {
        $this->service = app(GenresSettingService::class, ['type' => ClassifiedConstant::ANIME]);
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|Genres[]
     */
    public function index(ListRequestHandle $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param StoreRequestHandle $request
     * @return Genres|null
     */
    public function store(StoreRequestHandle $request)
    {
        return $this->service->create($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Genres|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function edit(GetIdRequestHandle $request)
    {
        return $this->service->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return Genres|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        return $this->service->update($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(GetIdRequestHandle $request)
    {
        return $this->service->delete($request);
    }
}
