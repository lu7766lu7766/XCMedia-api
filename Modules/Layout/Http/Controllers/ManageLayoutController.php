<?php

namespace Modules\Layout\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Branch\Repositories\BranchRepo;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;
use Modules\Layout\Http\Requests\DeleteRequestHandle;
use Modules\Layout\Http\Requests\EditRequestHandle;
use Modules\Layout\Http\Requests\ListRequestHandle;
use Modules\Layout\Http\Requests\StoreRequestHandle;
use Modules\Layout\Http\Requests\UpdateRequestHandle;
use Modules\Layout\Services\ManageLayoutService;

class ManageLayoutController extends Controller
{
    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Layout\Entities\Layout[]
     */
    public function index(ListRequestHandle $request)
    {
        return app(ManageLayoutService::class)->list($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return app(ManageLayoutService::class)->total($request);
    }

    /**
     * @param StoreRequestHandle $request
     * @return \Modules\Layout\Entities\Layout|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function store(StoreRequestHandle $request)
    {
        return app(ManageLayoutService::class)->create($request);
    }

    /**
     * @param EditRequestHandle $request
     * @return \Modules\Layout\Entities\Layout|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function edit(EditRequestHandle $request)
    {
        return app(ManageLayoutService::class)->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Modules\Layout\Entities\Layout|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        return app(ManageLayoutService::class)->update($request);
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function delete(DeleteRequestHandle $request)
    {
        return app(ManageLayoutService::class)->delete($request);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Branch\Entities\Branch[]
     */
    public function branch()
    {
        return app(BranchRepo::class)->all();
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
