<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 上午 10:54
 */

namespace Modules\Classified\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Modules\Classified\Entities\Cup;
use Modules\Classified\Http\Requests\Cup\CupIndexRequest;
use Modules\Classified\Http\Requests\Cup\CupInfoRequest;
use Modules\Classified\Http\Requests\Cup\CupStoreRequest;
use Modules\Classified\Http\Requests\Cup\CupTotalRequest;
use Modules\Classified\Http\Requests\Cup\CupUpdateRequest;
use Modules\Classified\Service\MediaCupService;

abstract class MediaCupController extends Controller
{
    /** @var MediaCupService $service */
    private $service;

    /**
     * @see CupUsedTypeConstants
     * @return string
     */
    abstract protected function genre(): string;

    /**
     * MediaCupController constructor.
     */
    public function __construct()
    {
        $this->service = app(MediaCupService::class, ['useType' => $this->genre()]);
    }

    /**
     * @param CupIndexRequest $request
     * @return Collection|Cup[]
     */
    public function index(CupIndexRequest $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param CupStoreRequest $request
     * @return Cup
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function store(CupStoreRequest $request)
    {
        return $this->service->create($request);
    }

    /**
     * @param CupInfoRequest $request
     * @return Cup|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function info(CupInfoRequest $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param CupUpdateRequest $request
     * @return Cup
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(CupUpdateRequest $request)
    {
        return $this->service->update($request);
    }

    /**
     * @param CupTotalRequest $request
     * @return int
     */
    public function total(CupTotalRequest $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param CupInfoRequest $request
     * @return Cup
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(CupInfoRequest $request)
    {
        return $this->service->delete($request);
    }
}
