<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/3
 * Time: 下午 02:55
 */

namespace Modules\Video\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Modules\Classified\Contracts\IActressProvider;
use Modules\Classified\Contracts\ICupProvider;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Files\Entities\EditorFiles;
use Modules\Files\Repositories\EditorFilesRepo;
use Modules\Files\Services\EditorFileUploadService;
use Modules\Video\Entities\AdultVideo;
use Modules\Video\Http\Requests\Manage\AdultVideoIndexRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoInfoRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoStoreRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoTotalRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoUpdateRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoUploadRequest;
use Modules\Video\Services\ManageAdultVideoService;

class ManageAdultVideoController extends Controller
{
    /** @var ManageAdultVideoService $service */
    private $service;

    /**
     * ManageAdultVideoController constructor.
     * @param ManageAdultVideoService $service
     */
    public function __construct(ManageAdultVideoService $service)
    {
        $this->service = $service;
    }

    /**
     * @param AdultVideoIndexRequest $request
     * @return Collection|AdultVideo[]
     */
    public function index(AdultVideoIndexRequest $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param AdultVideoTotalRequest $request
     * @return int
     */
    public function total(AdultVideoTotalRequest $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param AdultVideoStoreRequest $request
     * @param Cloud $cloud
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @param IYearsProvider $yearsProvider
     * @return AdultVideo
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function store(
        AdultVideoStoreRequest $request,
        Cloud $cloud,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider,
        IYearsProvider $yearsProvider
    ) {
        return $this->service->create(
            $request,
            $cloud,
            $regionProvider,
            $actressProvider,
            $cupProvider,
            $genresProvider,
            $yearsProvider,
            $this->editorFilesProvider()
        );
    }

    /**
     * @param AdultVideoInfoRequest $request
     * @return AdultVideo
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function info(AdultVideoInfoRequest $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param AdultVideoUpdateRequest $request
     * @param Cloud $cloud
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @param IYearsProvider $yearsProvider
     * @return AdultVideo
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(
        AdultVideoUpdateRequest $request,
        Cloud $cloud,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider,
        IYearsProvider $yearsProvider
    ) {
        return $this->service->update(
            $request,
            $cloud,
            $regionProvider,
            $actressProvider,
            $cupProvider,
            $genresProvider,
            $yearsProvider,
            $this->editorFilesProvider()
        );
    }

    /**
     * @param AdultVideoInfoRequest $request
     * @param Cloud $cloud
     * @return AdultVideo
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(AdultVideoInfoRequest $request, Cloud $cloud)
    {
        return $this->service->delete($request, $this->editorFilesProvider(), $cloud);
    }

    /**
     * @param IRegionProvider $repo
     * @return Collection|Model[]
     */
    public function region(IRegionProvider $repo)
    {
        return $this->service->region($repo);
    }

    /**
     * @param IActressProvider $repo
     * @return Collection|Model[]
     */
    public function actress(IActressProvider $repo)
    {
        return $this->service->actress($repo);
    }

    /**
     * @param ICupProvider $repo
     * @return Collection|Model[]
     */
    public function cup(ICupProvider $repo)
    {
        return $this->service->cup($repo);
    }

    /**
     * @param IGenresProvider $repo
     * @return Collection|Model[]
     */
    public function genres(IGenresProvider $repo)
    {
        return $this->service->genres($repo);
    }

    /**
     * @param IYearsProvider $repo
     * @return Collection|Model[]
     */
    public function years(IYearsProvider $repo)
    {
        return $this->service->years($repo);
    }

    /**
     * @param AdultVideoUploadRequest $request
     * @return EditorFiles|null
     */
    public function upload(AdultVideoUploadRequest $request)
    {
        $service = app(EditorFileUploadService::class);

        return $service->upload($request->getImage());
    }

    /**
     * @return IEditorFilesProvider
     */
    private function editorFilesProvider(): IEditorFilesProvider
    {
        return app(EditorFilesRepo::class);
    }
}
