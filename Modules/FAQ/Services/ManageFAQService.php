<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 04:53
 */

namespace Modules\FAQ\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Branch\Contracts\IBranchProvider;
use Modules\FAQ\Entities\FAQ;
use Modules\FAQ\Http\Requests\DeleteRequestHandle;
use Modules\FAQ\Http\Requests\EditRequestHandle;
use Modules\FAQ\Http\Requests\ListRequestHandle;
use Modules\FAQ\Http\Requests\StoreRequestHandle;
use Modules\FAQ\Http\Requests\UpdateRequestHandle;
use Modules\FAQ\Repositories\FAQRepo;
use Modules\Files\Contracts\IEditorFilesProvider;

class ManageFAQService
{
    /** @var FAQRepo $repo */
    private $repo;
    /** @var IBranchProvider $branchProvider */
    private $branchProvider;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var Cloud $storage */
    private $storage;

    /**
     * ManageBranchFAQService constructor.
     * @param IBranchProvider $branchProvider
     * @param IEditorFilesProvider $editorFilesProvider
     * @param Cloud $storage
     */
    public function __construct(
        IBranchProvider $branchProvider,
        IEditorFilesProvider $editorFilesProvider,
        Cloud $storage
    ) {
        $this->repo = new FAQRepo();
        $this->branchProvider = $branchProvider;
        $this->editorFilesProvider = $editorFilesProvider;
        $this->storage = $storage;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\FAQ\Entities\FAQ[]
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
     * @return FAQ|null
     * @throws ApiErrorCodeException
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
            'title'    => $request->getTitle(),
            'contents' => $request->getContents(),
            'status'   => $request->getStatus()
        ];
        $result = $this->repo->create($attributes, $branches, $editorFiles);

        return $result ? $result->load(['branches', 'editorFiles']) : null;
    }

    /**
     * @param EditRequestHandle $request
     * @return FAQ|null
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
     * @return FAQ|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        $result = null;
        $faq = $this->repo->find($request->getId());
        $branches = $this->branchProvider->getByIds($request->getBranches());
        $editorFiles = $this->editorFilesProvider->getByIds($request->getImageIds());
        if (is_null($faq) || $branches->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'title'    => $request->getTitle(),
            'contents' => $request->getContents(),
            'status'   => $request->getStatus()
        ];
        $result = $this->repo->update($faq, $attributes, $branches, $editorFiles);

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
        $faq = $this->repo->find($request->getId());
        if (is_null($faq)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $editorFilesIds = $faq->editorFiles()->pluck('editor_files.id')->toArray();
        if ($result = $this->repo->delete($faq)) {
            $unusedEditorFiles = $this->editorFilesProvider->getUnusedByIds($editorFilesIds);
            $this->storage->delete($unusedEditorFiles->pluck('file_path')->toArray());
            $this->editorFilesProvider->deleteByIds($unusedEditorFiles->pluck('id')->toArray());
        }

        return $result;
    }
}
