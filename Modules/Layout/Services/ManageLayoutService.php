<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/15
 * Time: 下午 03:01
 */

namespace Modules\Layout\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Branch\Contracts\IBranchProvider;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Layout\Http\Requests\DeleteRequestHandle;
use Modules\Layout\Http\Requests\EditRequestHandle;
use Modules\Layout\Http\Requests\ListRequestHandle;
use Modules\Layout\Http\Requests\StoreRequestHandle;
use Modules\Layout\Http\Requests\UpdateRequestHandle;
use Modules\Layout\Repositories\LayoutRepo;

class ManageLayoutService
{
    /** @var LayoutRepo $repo */
    private $repo;
    /** @var IBranchProvider $branchProvider */
    private $branchProvider;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var Cloud $storage */
    private $storage;

    /**
     * ManageLayoutService constructor.
     * @param IBranchProvider $branchProvider
     * @param IEditorFilesProvider $editorFilesProvider
     * @param Cloud $storage
     */
    public function __construct(
        IBranchProvider $branchProvider,
        IEditorFilesProvider $editorFilesProvider,
        Cloud $storage
    ) {
        $this->repo = new LayoutRepo();
        $this->branchProvider = $branchProvider;
        $this->editorFilesProvider = $editorFilesProvider;
        $this->storage = $storage;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Layout\Entities\Layout[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $request->getTitle(),
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
        return $this->repo->count($request->getTitle(), $request->getStatus());
    }

    /**
     * @param StoreRequestHandle $request
     * @return \Modules\Layout\Entities\Layout|null
     * @throws ApiErrorCodeException
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
            'title'    => $request->getTitle(),
            'code'     => $request->getCode(),
            'contents' => $request->getContents(),
            'status'   => $request->getStatus()
        ];
        $result = $this->repo->create($attributes, $branches, $editorFiles);

        return $result ? $result->load(['branches', 'editorFiles']) : null;
    }

    /**
     * @param EditRequestHandle $request
     * @return \Modules\Layout\Entities\Layout|null
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
     * @return \Modules\Layout\Entities\Layout|null
     * @throws ApiErrorCodeException
     */
    public function update(UpdateRequestHandle $request)
    {
        $result = null;
        $layout = $this->repo->find($request->getId());
        $branches = $this->branchProvider->getByIds($request->getBranches());
        $editorFiles = $this->editorFilesProvider->getByIds($request->getImageIds());
        if (is_null($layout) || $branches->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'title'    => $request->getTitle(),
            'code'     => $request->getCode(),
            'contents' => $request->getContents(),
            'status'   => $request->getStatus()
        ];
        $result = $this->repo->update($layout, $attributes, $branches, $editorFiles);

        return $result ? $result->load(['branches', 'editorFiles']) : null;
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     * @throws ApiErrorCodeException
     */
    public function delete(DeleteRequestHandle $request)
    {
        $layout = $this->repo->find($request->getId());
        if (is_null($layout)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $editorFilesIds = $layout->editorFiles()->pluck('editor_files.id')->toArray();
        if ($result = $this->repo->delete($layout)) {
            $unusedEditorFiles = $this->editorFilesProvider->getUnusedByIds($editorFilesIds);
            $this->storage->delete($unusedEditorFiles->pluck('file_path')->toArray());
            $this->editorFilesProvider->deleteByIds($unusedEditorFiles->pluck('id')->toArray());
        }

        return $result;
    }
}
