<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 下午 06:01
 */

namespace Modules\Classified\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\AVActressUsedTypeConstants;
use Modules\Classified\Entities\AVActress;
use Modules\Classified\Entities\Cup;
use Modules\Classified\Http\Requests\AVActress\AVActressIndexRequest;
use Modules\Classified\Http\Requests\AVActress\AVActressInfoRequest;
use Modules\Classified\Http\Requests\AVActress\AVActressStoreRequest;
use Modules\Classified\Http\Requests\AVActress\AVActressTotalRequest;
use Modules\Classified\Http\Requests\AVActress\AVActressUpdateRequest;
use Modules\Classified\Service\MediaActressService;

abstract class MediaActressController extends Controller
{
    /** @var MediaActressService $service */
    private $service;

    /**
     * @see AVActressUsedTypeConstants
     * @return string
     */
    abstract protected function genre(): string;

    /**
     * MediaActressController constructor.
     */
    public function __construct()
    {
        $this->service = app(MediaActressService::class, ['useType' => $this->genre()]);
    }

    /**
     * @param AVActressIndexRequest $request
     * @return Collection|Cup[]
     */
    public function index(AVActressIndexRequest $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param AVActressTotalRequest $request
     * @return int
     */
    public function total(AVActressTotalRequest $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param AVActressInfoRequest $request
     * @return AVActress
     * @throws ApiErrorCodeException
     */
    public function info(AVActressInfoRequest $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param AVActressStoreRequest $request
     * @return AVActress
     * @throws ApiErrorCodeException
     */
    public function store(AVActressStoreRequest $request)
    {
        return $this->service->create($request, app(Cloud::class));
    }

    /**
     * @param AVActressUpdateRequest $request
     * @return AVActress
     * @throws ApiErrorCodeException
     */
    public function update(AVActressUpdateRequest $request)
    {
        return $this->service->update($request, app(Cloud::class));
    }

    /**
     * @param AVActressInfoRequest $request
     * @return AVActress
     * @throws ApiErrorCodeException
     */
    public function delete(AVActressInfoRequest $request)
    {
        return $this->service->delete($request, app(Cloud::class));
    }
}
