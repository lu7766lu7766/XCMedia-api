<?php

namespace Modules\Variety\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\SourceSettingRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Episode\Constants\EpisodeStatusConstants;
use Modules\Episode\Contracts\IEpisodeOwnerRepo;
use Modules\Episode\Http\Controllers\EpisodeHelper;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;
use Modules\Variety\Http\Requests\GetIdRequestHandle;
use Modules\Variety\Http\Requests\ListRequestHandle;
use Modules\Variety\Http\Requests\StoreRequestHandle;
use Modules\Variety\Http\Requests\UpdateRequestHandle;
use Modules\Variety\Repositories\VarietyRepo;
use Modules\Variety\Services\ManageVarietyService;

class ManageVarietyController extends Controller
{
    use EpisodeHelper {
        EpisodeHelper::__construct as episodeConstruct;
    }
    private $service;

    /**
     * ManageVarietyController constructor.
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function __construct()
    {
        $this->service = app(ManageVarietyService::class);
        $this->episodeConstruct();
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Variety\Entities\Variety[]
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
     * @return \Modules\Variety\Entities\Variety|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        return $this->service->create($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return ManageVarietyService
     */
    public function edit(GetIdRequestHandle $request)
    {
        return $this->service->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Modules\Variety\Entities\Variety|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        return $this->service->update($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Modules\Variety\Entities\Variety|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(GetIdRequestHandle $request)
    {
        return $this->service->delete($request);
    }

    /**
     * @return array
     */
    public function getEpisodeStatus()
    {
        return EpisodeStatusConstants::enum();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Region[]
     */
    public function getRegion()
    {
        return app(RegionRepo::class)->getEnableByUsedType($this->getUsedType());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Years[]
     */
    public function getYears()
    {
        return app(YearsSettingRepo::class)->getEnableByType($this->getUsedType());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Language[]
     */
    public function getLanguage()
    {
        return app(LanguageSettingRepo::class)->getAllByUsedType($this->getUsedType());
    }

    public function getGenres()
    {
        return app(GenresSettingRepo::class)->getEnableUsedType($this->getUsedType());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Source
     */
    public function getSource()
    {
        return app(SourceSettingRepo::class, ['type' => $this->getUsedType()])->getAllByUsedType();
    }

    /**
     * @param UploadImageRequestHandle $request
     * @return \Modules\Files\Entities\EditorFiles|null
     */
    public function uploadImage(UploadImageRequestHandle $request)
    {
        return app(EditorFileUploadService::class)->upload($request->getImage());
    }

    /**
     * @param RemoveImageRequestHandle $request
     * @return int
     */
    public function removeImage(RemoveImageRequestHandle $request)
    {
        return app(EditorFileUploadService::class)->remove($request->getImageId());
    }

    /**
     * @return IEpisodeOwnerRepo
     */
    public function getEpisodeOwnerRepo(): IEpisodeOwnerRepo
    {
        return new VarietyRepo();
    }

    /**
     * @return string
     */
    public function getUsedType(): string
    {
        return ClassifiedConstant::VARIETY;
    }
}
