<?php

namespace Modules\FAQ\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Branch\Repositories\BranchRepo;
use Modules\FAQ\Http\Requests\DeleteRequestHandle;
use Modules\FAQ\Http\Requests\EditRequestHandle;
use Modules\FAQ\Http\Requests\ListRequestHandle;
use Modules\FAQ\Http\Requests\StoreRequestHandle;
use Modules\FAQ\Http\Requests\UpdateRequestHandle;
use Modules\FAQ\Services\ManageFAQService;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;

class ManageFAQController extends Controller
{
    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\FAQ\Entities\FAQ[]
     */
    public function index(ListRequestHandle $request)
    {
        return app(ManageFAQService::class)->list($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return app(ManageFAQService::class)->total($request);
    }

    /**
     * @param StoreRequestHandle $request
     * @return null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        return app(ManageFAQService::class)->create($request);
    }

    /**
     * @param EditRequestHandle $request
     * @return \Modules\FAQ\Entities\FAQ|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function edit(EditRequestHandle $request)
    {
        return app(ManageFAQService::class)->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Modules\FAQ\Entities\FAQ|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        return app(ManageFAQService::class)->update($request);
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request)
    {
        return app(ManageFAQService::class)->delete($request);
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
