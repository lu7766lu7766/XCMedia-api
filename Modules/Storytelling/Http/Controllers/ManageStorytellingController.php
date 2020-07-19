<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/11
 * Time: 下午 04:08
 */

namespace Modules\Storytelling\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;
use Modules\Storytelling\Entities\Storytelling;
use Modules\Storytelling\Http\Requests\Manage\Storytelling\GetIdRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\Storytelling\ListRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\Storytelling\StoreRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\Storytelling\UpdateRequestHandle;
use Modules\Storytelling\Services\ManageStorytellingService;

class ManageStorytellingController extends Controller
{
    /** @var ManageStorytellingService $service */
    private $service;

    /**
     * ManageStorytellingController constructor.
     */
    public function __construct()
    {
        $this->service = app(ManageStorytellingService::class);
    }

    /**
     * @param StoreRequestHandle $request
     * @param Cloud $cloud
     * @return Storytelling|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request, Cloud $cloud)
    {
        return $this->service->create($request, $cloud);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Storytelling|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function info(GetIdRequestHandle $request)
    {
        return $this->service->info($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return Collection|Storytelling[]
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
     * @param UpdateRequestHandle $request
     * @param Cloud $cloud
     * @return Storytelling|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request, Cloud $cloud)
    {
        return $this->service->update($request, $cloud);
    }

    /**
     * @param GetIdRequestHandle $request
     * @param Cloud $cloud
     * @return Storytelling|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(GetIdRequestHandle $request, Cloud $cloud)
    {
        return $this->service->delete($request, $cloud);
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
     * @param IRegionProvider $repo
     * @return Collection|Model[]
     */
    public function region(IRegionProvider $repo)
    {
        return $this->service->region($repo);
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
     * @return array
     */
    public function status()
    {
        return NYEnumConstants::enum();
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
}
