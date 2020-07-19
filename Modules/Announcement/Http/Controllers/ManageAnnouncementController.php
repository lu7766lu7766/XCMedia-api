<?php

namespace Modules\Announcement\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Announcement\Http\Requests\DeleteRequestHandle;
use Modules\Announcement\Http\Requests\EditRequestHandle;
use Modules\Announcement\Http\Requests\ListRequestHandle;
use Modules\Announcement\Http\Requests\StoreRequestHandle;
use Modules\Announcement\Http\Requests\UpdateRequestHandle;
use Modules\Announcement\Services\ManageAnnouncementService;
use Modules\Branch\Repositories\BranchRepo;
use Modules\Files\Http\Requests\RemoveImageRequestHandle;
use Modules\Files\Http\Requests\UploadImageRequestHandle;
use Modules\Files\Services\EditorFileUploadService;

class ManageAnnouncementController extends Controller
{
    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Announcement\Entities\Announcement[]
     */
    public function index(ListRequestHandle $request)
    {
        return app(ManageAnnouncementService::class)->list($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return app(ManageAnnouncementService::class)->total($request);
    }

    /**
     * @param StoreRequestHandle $request
     * @return \Modules\Announcement\Entities\Announcement|null
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        return app(ManageAnnouncementService::class)->create($request);
    }

    /**
     * @param EditRequestHandle $request
     * @return \Modules\Announcement\Entities\Announcement|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function edit(EditRequestHandle $request)
    {
        return app(ManageAnnouncementService::class)->edit($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \Modules\Announcement\Entities\Announcement|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        return app(ManageAnnouncementService::class)->update($request);
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request)
    {
        return app(ManageAnnouncementService::class)->delete($request);
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
