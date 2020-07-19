<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/14
 * Time: 下午 04:43
 */

namespace Modules\Anime\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Anime\Http\Requests\GetIdRequestHandle;
use Modules\Anime\Http\Requests\ListRequestHandle;
use Modules\Anime\Http\Requests\StoreRequestHandle;
use Modules\Anime\Http\Requests\UpdateRequestHandle;
use Modules\Anime\Repositories\AnimeRepo;
use Modules\Anime\Services\ManageAnimeService;
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

class ManageAnimeController extends Controller
{
    use EpisodeHelper {
        EpisodeHelper::__construct as episodeConstruct;
    }
    /** @var ManageAnimeService $service */
    private $service;

    /**
     * ManageAnimeController constructor.
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function __construct()
    {
        $this->service = app(ManageAnimeService::class);
        $this->episodeConstruct();
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Anime\Entities\Anime[]
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
     * @return \Modules\Anime\Entities\Anime|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        return $this->service->create($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Modules\Anime\Entities\Anime|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function edit(GetIdRequestHandle $request)
    {
        return $this->service->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Modules\Anime\Entities\Anime|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        return $this->service->update($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Modules\Anime\Entities\Anime|null
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
        return new AnimeRepo();
    }

    /**
     * @return string
     */
    public function getUsedType(): string
    {
        return ClassifiedConstant::ANIME;
    }
}
