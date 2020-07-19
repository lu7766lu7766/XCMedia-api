<?php

namespace Modules\Movie\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Cloud;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\SourceSettingRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Episode\Contracts\IEpisodeOwnerRepo;
use Modules\Episode\Http\Controllers\EpisodeHelper;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;
use Modules\Movie\Http\Requests\Manage\MovieEditRequest;
use Modules\Movie\Http\Requests\Manage\MovieIndexRequest;
use Modules\Movie\Http\Requests\Manage\MovieInfoRequest;
use Modules\Movie\Http\Requests\Manage\MovieUpdateRequest;
use Modules\Movie\Repositories\MovieRepo;
use Modules\Movie\Services\ManageMovieService;

class ManageMovieController extends Controller
{
    use EpisodeHelper {
        EpisodeHelper::__construct as episodeConstruct;
    }
    /** @var ManageMovieService $service */
    private $service;

    public function __construct()
    {
        $this->service = app(ManageMovieService::class);
        $this->episodeConstruct();
    }

    /**
     * @param MovieIndexRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Movie\Entities\Movie[]
     */
    public function index(MovieIndexRequest $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param MovieIndexRequest $request
     * @return int
     */
    public function total(MovieIndexRequest $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param MovieInfoRequest $request
     * @return \Modules\Movie\Entities\Movie|null
     */
    public function info(MovieInfoRequest $request)
    {
        return $this->service->info($request->getId());
    }

    /**
     * @param MovieEditRequest $request
     * @return \Modules\Movie\Entities\Movie
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(MovieEditRequest $request)
    {
        return $this->service->store($request, app(Cloud::class));
    }

    /**
     * @param MovieUpdateRequest $request
     * @return \Modules\Movie\Entities\Movie
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(MovieUpdateRequest $request)
    {
        return $this->service->update($request, app(Cloud::class));
    }

    /**
     * @param MovieInfoRequest $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(MovieInfoRequest $request)
    {
        return $this->service->delete($request, app(Cloud::class));
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

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Genres[]
     */
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
     * @inheritDoc
     */
    public function getEpisodeOwnerRepo(): IEpisodeOwnerRepo
    {
        return new MovieRepo();
    }

    /**
     * @inheritDoc
     */
    public function getUsedType(): string
    {
        return ClassifiedConstant::MOVIE;
    }
}
