<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/04
 * Time: 下午 06:22
 */

namespace Modules\Literature\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Literature\Entities\Literature;
use Modules\Literature\Http\Requests\AddRequestHandle;
use Modules\Literature\Http\Requests\CountRequestHandle;
use Modules\Literature\Http\Requests\DeleteRequestHandle;
use Modules\Literature\Http\Requests\ListRequestHandle;
use Modules\Literature\Http\Requests\UpdateRequestHandle;
use Modules\Literature\Repositories\LiteratureRepo;

class LiteratureService
{
    /** @var LiteratureRepo $repo */
    private $repo;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var string $type */
    private $type;

    public function __construct(
        LiteratureRepo $repo,
        IEditorFilesProvider $editorFilesProvider
    ) {
        $this->type = ClassifiedConstant::LITERATURE;
        $this->repo = $repo;
        $this->editorFilesProvider = $editorFilesProvider;
    }

    /**
     * @param AddRequestHandle $request
     * @param Cloud $cloud
     * @return Literature
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function add(AddRequestHandle $request, Cloud $cloud)
    {
        $attributes = [
            'title'       => $request->getTitle(),
            'status'      => $request->getStatus(),
            'alias'       => $request->getAlias(),
            'tags'        => $request->getTags(),
            'description' => $request->getDescription(),
            'views'       => $request->getViews(),
            'score'       => $request->getScore()
        ];
        if (!is_null($cover = $request->getCover())) {
            [$coverPath, $coverUrl] = $this->uploadFile($cloud, $request->getCover());
            $attributes['cover_url'] = $coverUrl;
            $attributes['cover_path'] = $coverPath;
        }
        $genresIds = $this->filterGenres($request->getGenresIds());
        $imagesIds = $request->getImageIds();
        $region = $this->findRegion($request->getRegionId());
        $year = $this->findYear($request->getYearId());
        /** @var Literature $result */
        $result = null;
        \DB::transaction(function () use (
            $attributes,
            $genresIds,
            $imagesIds,
            $region,
            $year,
            &$result
        ) {
            $result = app(Literature::class)->fill($attributes);
            $result->year()->associate($year);
            $result->region()->associate($region);
            $result->save();
            $result->genres()->sync($genresIds);
            $result->editorFiles()->sync($imagesIds);
            $result->load(['year', 'region', 'genres', 'editorFiles']);
        });
        if (is_null($result)) {
            $result = null;
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'Literature create failed.');
        }

        return $result;
    }

    /**
     * @param UpdateRequestHandle $request
     * @param Cloud $cloud
     * @return Literature
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request, Cloud $cloud)
    {
        $literature = $this->findLiteratureOrThrow($request->getId());
        $attributes = [
            'title'       => $request->getTitle(),
            'status'      => $request->getStatus(),
            'tags'        => $request->getTags(),
            'description' => $request->getDescription(),
            'alias'       => $request->getAlias(),
            'views'       => $request->getViews(),
            'score'       => $request->getScore()
        ];
        if ($request->getRemoveCover()) {
            $cloud->delete($literature->cover_path);
            $literature->cover_path = null;
            $literature->cover_url = null;
        }
        if (!is_null($coverFile = $request->getCover())) {
            $cloud->delete($literature->cover_path);
            // 有上傳封面才更新封面
            [$coverPath, $coverUrl] = $this->uploadFile($cloud, $coverFile);
            $literature->cover_path = $coverPath;
            $literature->cover_url = $coverUrl;
        }
        $genresIds = $this->filterGenres($request->getGenresIds());
        $imageIds = $request->getImageIds();
        $region = $this->findRegion($request->getRegionId());
        $year = $this->findYear($request->getYearId());
        /** @var Literature $result */
        $result = null;
        \DB::transaction(function () use (
            $literature,
            $attributes,
            $genresIds,
            $imageIds,
            $region,
            $year,
            &$result
        ) {
            $result = $this->repo->update($literature, $attributes);
            $result->year()->associate($year);
            $result->region()->associate($region);
            $result->save();
            $result->genres()->sync($genresIds);
            if (!empty($imageIds)) {
                $result->editorFiles()->sync($imageIds);
            }
            $result->load(['genres', 'region', 'year', 'editorFiles']);
        });
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'Literature update failed.');
        }

        return $result;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|Literature[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->list(
            $request->getTitle(),
            $request->getRegionId(),
            $request->getGenresIds(),
            $request->getYearId(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param CountRequestHandle $request
     * @return int
     */
    public function count(CountRequestHandle $request)
    {
        return $this->repo->count(
            $request->getTitle(),
            $request->getRegionId(),
            $request->getGenresIds(),
            $request->getYearId(),
            $request->getStatus()
        );
    }

    /**
     * @param DeleteRequestHandle $request
     * @param Cloud $cloud
     * @return Literature
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request, Cloud $cloud)
    {
        $literature = $this->findLiteratureOrThrow($request->getId());
        /** @var Literature $result */
        $result = null;
        \DB::transaction(function () use ($literature, &$result) {
            // 刪除literature中的資料
            $result = $this->repo->delete($literature);
            // 解除與genres的關聯
            $literature->genres()->detach();
            $editorFilesIds = $literature->editorFiles()->pluck('editor_files.id')->toArray();
            // 解除與editor_files的關聯
            $literature->editorFiles()->detach();
            $unusedFilesIds = $this->editorFilesProvider->getUnusedByIds($editorFilesIds)
                ->pluck('editor_files.id')->toArray();
            // 刪除未使用的editor_files雲端檔案
            $this->editorFilesProvider->deleteByIds($unusedFilesIds);
        });
        $coverPath = $literature->getAttribute('cover_path');
        if (!is_null($coverPath)) {
            // 刪除雲端檔案
            $cloud->delete($coverPath);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string|null $status
     * @return Literature|null
     * @throws ApiErrorCodeException
     */
    private function findLiteratureOrThrow(int $id, string $status = null)
    {
        $result = $this->repo->find($id, $status);
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Literature not found.');
        }

        return $result;
    }

    /**
     * @param Cloud $cloud
     * @param UploadedFile $file
     * @return array
     * @throws ApiErrorCodeException
     */
    private function uploadFile(Cloud $cloud, UploadedFile $file)
    {
        $filePath = null;
        $fileUrl = null;
        if (!is_null($file)) {
            $filePath = $cloud->put(
                config('Literature.config.literature_cover_path'),
                $file,
                Filesystem::VISIBILITY_PUBLIC
            );
            if (is_bool($filePath)) {
                throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'File upload failed.');
            }
            $fileUrl = $cloud->url($filePath);
        }

        return [$filePath, $fileUrl];
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|RegionRepo|null|object
     * @throws ApiErrorCodeException
     */
    private function findRegion(int $id)
    {
        $result = app(RegionRepo::class)->findEnableByType($id, $this->type);
        if ($result == null) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Region not found.');
        }

        return $result;
    }

    /**
     * @param int $id
     * @return \Modules\Classified\Entities\Years|null
     * @throws ApiErrorCodeException
     */
    private function findYear(int $id)
    {
        $result = app(YearsSettingRepo::class)->findEnableByType($id, $this->type);
        if ($result == null) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Year not found.');
        }

        return $result;
    }

    /**
     * @param array $genresIds
     * @return array
     */
    private function filterGenres(array $genresIds)
    {
        return app(GenresSettingRepo::class)
            ->getEnableByIds($genresIds, $this->type)
            ->pluck('id')
            ->toArray();
    }
}
