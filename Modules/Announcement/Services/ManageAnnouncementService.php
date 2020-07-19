<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/6
 * Time: 下午 06:16
 */

namespace Modules\Announcement\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Modules\Announcement\Entities\Announcement;
use Modules\Announcement\Http\Requests\DeleteRequestHandle;
use Modules\Announcement\Http\Requests\EditRequestHandle;
use Modules\Announcement\Http\Requests\ListRequestHandle;
use Modules\Announcement\Http\Requests\StoreRequestHandle;
use Modules\Announcement\Http\Requests\UpdateRequestHandle;
use Modules\Announcement\Repositories\AnnouncementRepo;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Branch\Contracts\IBranchProvider;
use Modules\Files\Contracts\IEditorFilesProvider;

class ManageAnnouncementService
{
    /** @var AnnouncementRepo $repo */
    private $repo;
    /** @var IBranchProvider $branchProvider */
    private $branchProvider;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var Cloud $storage */
    private $storage;

    /**
     * ManageAnnouncementService constructor.
     * @param IBranchProvider $branchProvider
     * @param IEditorFilesProvider $editorFilesProvider
     * @param Cloud $storage
     */
    public function __construct(
        IBranchProvider $branchProvider,
        IEditorFilesProvider $editorFilesProvider,
        Cloud $storage
    ) {
        $this->repo = new AnnouncementRepo();
        $this->branchProvider = $branchProvider;
        $this->editorFilesProvider = $editorFilesProvider;
        $this->storage = $storage;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Announcement\Entities\Announcement[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $request->getTitle(),
            $request->getMarqueeSwitch(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return $this->repo->count(
            $request->getTitle(),
            $request->getMarqueeSwitch(),
            $request->getStatus()
        );
    }

    /**
     * @param StoreRequestHandle $request
     * @return Announcement|null
     * @throws \Throwable
     */
    public function create(StoreRequestHandle $request)
    {
        $result = null;
        $branches = $this->branchProvider->getByIds($request->getBranches());
        $editorFiles = $this->editorFilesProvider->getByIds($request->getImageIds());
        if ($branches->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'title'          => $request->getTitle(),
            'contents'       => $request->getContents(),
            'marquee_switch' => $request->getMarqueeSwitch(),
            'status'         => $request->getStatus()
        ];
        $result = $this->repo->create($attributes, $branches, $editorFiles);

        return $result ? $result->load(['branches', 'editorFiles']) : null;
    }

    /**
     * @param EditRequestHandle $request
     * @return Announcement|null
     * @throws ApiErrorCodeException
     */
    public function edit(EditRequestHandle $request)
    {
        $result = $this->repo->find($request->getId());
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }

        return $result->load(['branches', 'editorFiles']);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return Announcement|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        $result = null;
        $announcement = $this->repo->find($request->getId());
        $branches = $this->branchProvider->getByIds($request->getBranches());
        $editorFiles = $this->editorFilesProvider->getByIds($request->getImageIds());
        if (is_null($announcement) || $branches->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'title'          => $request->getTitle(),
            'contents'       => $request->getContents(),
            'marquee_switch' => $request->getMarqueeSwitch(),
            'status'         => $request->getStatus()
        ];
        $result = $this->repo->update($announcement, $attributes, $branches, $editorFiles);

        return $result ? $result->load(['branches', 'editorFiles']) : null;
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request)
    {
        $announcement = $this->repo->find($request->getId());
        if (is_null($announcement)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $editorFilesIds = $announcement->editorFiles()->pluck('editor_files.id')->toArray();
        if ($result = $this->repo->delete($announcement)) {
            $unusedEditorFiles = $this->editorFilesProvider->getUnusedByIds($editorFilesIds);
            $this->storage->delete($unusedEditorFiles->pluck('file_path')->toArray());
            $this->editorFilesProvider->deleteByIds($unusedEditorFiles->pluck('id')->toArray());
        }

        return $result;
    }
}
