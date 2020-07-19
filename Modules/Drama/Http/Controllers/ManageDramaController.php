<?php

namespace Modules\Drama\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\SourceSettingRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Drama\Http\Requests\GetIdRequestHandle;
use Modules\Drama\Http\Requests\ListRequestHandle;
use Modules\Drama\Http\Requests\StoreRequestHandle;
use Modules\Drama\Http\Requests\UpdateRequestHandle;
use Modules\Drama\Repositories\DramaRepo;
use Modules\Drama\Services\ManageDramaService;
use Modules\Episode\Constants\EpisodeStatusConstants;
use Modules\Episode\Contracts\IEpisodeOwnerRepo;
use Modules\Episode\Http\Controllers\EpisodeHelper;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;

class ManageDramaController extends Controller
{
    use EpisodeHelper {
        EpisodeHelper::__construct as episodeConstruct;
    }
    /** @var ManageDramaService $service */
    private $service;

    /**
     * ManageDramaController constructor.
     */
    public function __construct()
    {
        $this->service = app(ManageDramaService::class);
        $this->episodeConstruct();
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Drama\Entities\Drama[]
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
     * @return \Modules\Drama\Entities\Drama|null
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        return $this->service->create($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Modules\Drama\Entities\Drama|null
     */
    public function edit(GetIdRequestHandle $request)
    {
        return $this->service->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Modules\Drama\Entities\Drama|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        return $this->service->update($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Modules\Drama\Entities\Drama|null
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
        return new DramaRepo();
    }

    /**
     * @return string
     */
    public function getUsedType(): string
    {
        return ClassifiedConstant::DRAMA;
    }
}
