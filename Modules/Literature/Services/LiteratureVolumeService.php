<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/10
 * Time: 下午 07:11
 */

namespace Modules\Literature\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Literature\Entities\Literature;
use Modules\Literature\Entities\LiteratureVolume;
use Modules\Literature\Http\Requests\VolumeAddRequestHandle;
use Modules\Literature\Http\Requests\VolumeCountRequestHandle;
use Modules\Literature\Http\Requests\VolumeDeleteRequestHandle;
use Modules\Literature\Http\Requests\VolumeListRequestHandle;
use Modules\Literature\Http\Requests\VolumeUpdateRequestHandle;
use Modules\Literature\Repositories\LiteratureRepo;
use Modules\Literature\Repositories\LiteratureVolumeRepo;

class LiteratureVolumeService
{
    /** @var LiteratureVolumeRepo $repo */
    private $repo;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var LiteratureRepo $literatureRepo */
    private $literatureRepo;

    /**
     * LiteratureVolumeService constructor.
     * @param LiteratureVolumeRepo $repo
     * @param IEditorFilesProvider $editorFilesProvider
     */
    public function __construct(LiteratureVolumeRepo $repo, IEditorFilesProvider $editorFilesProvider)
    {
        $this->repo = $repo;
        $this->literatureRepo = app(LiteratureRepo::class);
        $this->editorFilesProvider = $editorFilesProvider;
    }

    /**
     * @param int $id
     * @return Literature
     * @throws ApiErrorCodeException
     */
    private function findLiteratureOrThrow(int $id): Literature
    {
        $result = $this->literatureRepo->find($id);
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Literature not found.');
        }

        return $result;
    }

    /**
     * @param int $literatureId
     * @param int $id
     * @return LiteratureVolume
     * @throws ApiErrorCodeException
     */
    private function findLiteratureVolumeOrThrow(int $literatureId, int $id): LiteratureVolume
    {
        $result = $this->repo->find($literatureId, $id);
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Literature volume not found.');
        }

        return $result;
    }

    /**
     * @param VolumeAddRequestHandle $request
     * @return LiteratureVolume
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function add(VolumeAddRequestHandle $request)
    {
        $literature = $this->findLiteratureOrThrow($request->getLiteratureId());
        $attributes = [
            'title'   => $request->getTitle(),
            'open_at' => $request->getOpenAt(),
            'content' => $request->getVolumeContent(),
            'status'  => $request->getStatus(),
        ];
        $imageIds = $request->getImageIds();
        /** @var LiteratureVolume $result */
        $result = null;
        \DB::transaction(function () use ($attributes, $literature, $imageIds, &$result) {
            $result = $this->repo->add($attributes, $literature);
            $result->editorFiles()->sync($imageIds);
        });
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'Literature volume create failed.');
        }

        return $result;
    }

    /**
     * @param VolumeListRequestHandle $request
     * @return LiteratureVolume[]|Collection
     */
    public function list(VolumeListRequestHandle $request)
    {
        $literatureId = $request->getLiteratureId();
        /** @var LiteratureVolume[]|Collection $result */
        $result = $this->repo->list($literatureId, $request->getPage(), $request->getPerpage());

        return $result;
    }

    /**
     * @param VolumeUpdateRequestHandle $request
     * @return LiteratureVolume
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(VolumeUpdateRequestHandle $request)
    {
        $literatureVolume = $this->findLiteratureVolumeOrThrow($request->getLiteratureId(), $request->getId());
        $attributes = [
            'title'   => $request->getTitle(),
            'open_at' => $request->getOpenAt(),
            'content' => $request->getVolumeContent(),
            'status'  => $request->getStatus(),
        ];
        $imageIds = $request->getImageIds();
        /** @var LiteratureVolume $result */
        $result = null;
        \DB::transaction(function () use ($literatureVolume, $attributes, $imageIds, &$result) {
            $result = $this->repo->update($literatureVolume, $attributes);
            if (!empty($imageIds)) {
                $result->editorFiles()->sync($imageIds);
            }
        });
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'Literature volume update failed.');
        }

        return $result;
    }

    /**
     * @param VolumeCountRequestHandle $request
     * @return int
     */
    public function count(VolumeCountRequestHandle $request)
    {
        $literatureId = $request->getLiteratureId();
        $result = $this->repo->count($literatureId);

        return $result;
    }

    /**
     * @param VolumeDeleteRequestHandle $request
     * @return LiteratureVolume
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(VolumeDeleteRequestHandle $request)
    {
        $literatureVolume = $this->findLiteratureVolumeOrThrow($request->getLiteratureId(), $request->getId());
        /** @var LiteratureVolume $result */
        $result = null;
        \DB::transaction(function () use ($literatureVolume, &$result) {
            $result = $this->repo->delete($literatureVolume);
            $literatureVolume->editorFiles()->delete();
            // 刪除editor_files雲端檔案
            $editorFilesIds = $literatureVolume->editorFiles()->pluck('editor_files.id')->toArray();
            $literatureVolume->editorFiles()->detach();
            $unusedFilesIds = $this->editorFilesProvider->getUnusedByIds($editorFilesIds)->pluck('editor_files.id')->toArray();
            $this->editorFilesProvider->deleteByIds($unusedFilesIds);
        });

        return $result;
    }
}
