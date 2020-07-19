<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/3
 * Time: 下午 02:54
 */

namespace Modules\Video\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\ApiCode\OOOO5AdultVideoCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Constants\AVActressUsedTypeConstants;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Constants\CupUsedTypeConstants;
use Modules\Classified\Constants\RegionUsedTypeConstants;
use Modules\Classified\Contracts\IActressProvider;
use Modules\Classified\Contracts\ICupProvider;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Video\Entities\AdultVideo;
use Modules\Video\Http\Requests\Manage\AdultVideoIndexRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoInfoRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoStoreRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoTotalRequest;
use Modules\Video\Http\Requests\Manage\AdultVideoUpdateRequest;
use Modules\Video\Repositories\AdultVideoRepo;

class ManageAdultVideoService
{
    /** @var AdultVideoRepo $repo */
    private $repo;

    /**
     * ManageAdultVideoService constructor.
     * @param AdultVideoRepo $repo
     */
    public function __construct(AdultVideoRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param AdultVideoIndexRequest $request
     * @return Collection|AdultVideo[]
     */
    public function list(AdultVideoIndexRequest $request)
    {
        return $this->repo->book(
            $request->getRegionId(),
            $request->getAvActressIds(),
            $request->getCupId(),
            $request->getYearsId(),
            $request->getStatus(),
            $request->getKeyword(),
            $request->getPage(),
            $request->getPerPage()
        )->load(['actress', 'genres', 'source', 'cup', 'years', 'bucket']);
    }

    /**
     * @param AdultVideoTotalRequest $request
     * @return int
     */
    public function total(AdultVideoTotalRequest $request): int
    {
        return $this->repo->count(
            $request->getRegionId(),
            $request->getAvActressIds(),
            $request->getCupId(),
            $request->getYearsId(),
            $request->getStatus(),
            $request->getKeyword()
        );
    }

    /**
     * @param AdultVideoInfoRequest $request
     * @return AdultVideo
     * @throws ApiErrorCodeException
     */
    public function info(AdultVideoInfoRequest $request): AdultVideo
    {
        $video = $this->repo->find($request->getId());
        if (is_null($video)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ADULT ViDEO MODEL NOT FOUND');
        }

        return $video;
    }

    /**
     * @param AdultVideoStoreRequest $request
     * @param Cloud $cloud
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @param IYearsProvider $yearsProvider
     * @param IEditorFilesProvider $editorFilesProvider
     * @return AdultVideo
     * @throws ApiErrorCodeException
     */
    public function create(
        AdultVideoStoreRequest $request,
        Cloud $cloud,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider,
        IYearsProvider $yearsProvider,
        IEditorFilesProvider $editorFilesProvider
    ): AdultVideo {
        $region = $this->validRegion($request->getRegionId(), $regionProvider);
        $actress = $this->validAVActress($request->getAvActressIds(), $actressProvider);
        $cup = $this->validCup($request->getCupId(), $cupProvider);
        $genres = $this->validGenres($request->getGenresIds(), $genresProvider);
        $years = $this->validYears($request->getYearsId(), $yearsProvider);
        $editorFiles = $editorFilesProvider->getByIds($request->getEditorImageIds());
        $attribute = [
            'title'       => $request->getTitle(),
            'alias'       => $request->getAlias(),
            'tags'        => $request->getTags(),
            'description' => $request->getDescription(),
            'status'      => $request->getStatus(),
            'views'       => $request->getViews(),
            'score'       => $request->getScore()
        ];
        if (!is_null($cover = $request->getCover())) {
            $coverPath = $this->upload($cloud, $cover, config('Video.config.adult_video_cover_path'));
            $attribute['cover_path'] = $coverPath;
            $attribute['cover_url'] = $cloud->url($coverPath);
        }
        try {
            $video = new AdultVideo($attribute);
            \DB::transaction(function () use ($video, $region, $cup, $years, $actress, $genres, $editorFiles) {
                $video->source()->associate($region);
                $video->cup()->associate($cup);
                $video->years()->associate($years);
                $video->push();
                $video->actress()->sync($actress);
                $video->genres()->sync($genres);
                $video->usedEditorFile($editorFiles);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL);
        }

        return $video;
    }

    /**
     * @param AdultVideoUpdateRequest $request
     * @param Cloud $cloud
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @param IYearsProvider $yearsProvider
     * @param IEditorFilesProvider $editorFilesProvider
     * @return AdultVideo
     * @throws ApiErrorCodeException
     */
    public function update(
        AdultVideoUpdateRequest $request,
        Cloud $cloud,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider,
        IYearsProvider $yearsProvider,
        IEditorFilesProvider $editorFilesProvider
    ): AdultVideo {
        $video = $this->repo->find($request->getId());
        if (is_null($video)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ADULT VIDEO MODEL NOT FOUND');
        }
        $region = $this->validRegion($request->getRegionId(), $regionProvider);
        $actress = $this->validAVActress($request->getAvActressIds(), $actressProvider);
        $cup = $this->validCup($request->getCupId(), $cupProvider);
        $genres = $this->validGenres($request->getGenresIds(), $genresProvider);
        $years = $this->validYears($request->getYearsId(), $yearsProvider);
        $editorFiles = $editorFilesProvider->getByIds($request->getEditorImageIds());
        $attribute = [
            'title'       => $request->getTitle(),
            'alias'       => $request->getAlias(),
            'tags'        => $request->getTags(),
            'description' => $request->getDescription(),
            'status'      => $request->getStatus(),
            'views'       => $request->getViews(),
            'score'       => $request->getScore()
        ];
        if ($request->getRemoveCover()) {
            $cloud->delete($video->cover_path);
            $video->cover_path = null;
            $video->cover_url = null;
        }
        if (!is_null($cover = $request->getCover())) {
            $coverPath = $this->upload($cloud, $cover, '');
            $attribute['cover_path'] = $coverPath;
            $attribute['cover_url'] = $cloud->url($coverPath);
            if (!is_null($video->cover_path)) {
                $cloud->delete($video->cover_path);
            }
        }
        $video->fill($attribute);
        try {
            \DB::transaction(function () use ($video, $region, $actress, $cup, $genres, $years, $editorFiles) {
                $video->source()->associate($region);
                $video->cup()->associate($cup);
                $video->years()->associate($years);
                $video->actress()->sync($actress);
                $video->genres()->sync($genres);
                $video->usedEditorFile($editorFiles);
                $video->push();
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw  new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'ADULT VIDEO UPDATE FAIL');
        }

        return $video;
    }

    /**
     * @param AdultVideoInfoRequest $request
     * @param IEditorFilesProvider $provider
     * @param Cloud $cloud
     * @return AdultVideo
     * @throws ApiErrorCodeException
     */
    public function delete(AdultVideoInfoRequest $request, IEditorFilesProvider $provider, Cloud $cloud)
    {
        $video = $this->repo->find($request->getId());
        if (is_null($video)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ADULT VIDEO MODEL NOT FOUND');
        }
        if (!is_null($video->cover_path)) {
            $cloud->delete($video->cover_path);
        }
        $unusedFiles = $provider->getUnusedByIds($video->editorFiles->pluck('editor_files.id')->toArray());
        $cloud->delete($unusedFiles->pluck('file_path')->toArray());
        try {
            \DB::transaction(function () use ($video, $provider) {
                $video->genres()->detach();
                $video->cancelEditorFile();
                $video->actress()->detach();
                $video->delete();
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'ADULT VIDEO UPDATE FAIL');
        }

        return $video;
    }

    /**
     * @param Cloud $cloud
     * @param UploadedFile $file
     * @param string $path
     * @return bool|string
     * @throws ApiErrorCodeException
     */
    private function upload(Cloud $cloud, UploadedFile $file, string $path)
    {
        /** @var bool|string $path */
        $path = $cloud->put($path, $file, $cloud::VISIBILITY_PUBLIC);
        if (is_bool($path)) {
            throw  new ApiErrorCodeException(OOOO5AdultVideoCodes::UPLOAD_FILE_FAIL, 'UPLOAD FILE FAIL');
        }

        return $path;
    }

    /**
     * @param int $id
     * @param IRegionProvider $repo
     * @return Model
     * @throws ApiErrorCodeException
     */
    private function validRegion(int $id, IRegionProvider $repo): Model
    {
        $region = $repo->findEnableByType($id, RegionUsedTypeConstants::VIDEO);
        if (is_null($region)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'REGION MODEL NOT FOUND');
        }

        return $region;
    }

    /**
     * @param array $ids
     * @param IActressProvider $repo
     * @return Collection|Model[]
     * @throws ApiErrorCodeException
     */
    private function validAVActress(array $ids, IActressProvider $repo)
    {
        $actress = $repo->findEnableByUsedType($ids, AVActressUsedTypeConstants::VIDEO);
        if ($actress->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'AV ACTRESS MODEL NOT FOUND');
        }

        return $actress;
    }

    /**
     * @param int $id
     * @param ICupProvider $repo
     * @return Model
     * @throws ApiErrorCodeException
     */
    private function validCup(int $id, ICupProvider $repo): Model
    {
        $cup = $repo->findByUsedType(CupUsedTypeConstants::VIDEO, $id);
        if (is_null($cup)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'CUP MODEL NOT FOUND');
        }

        return $cup;
    }

    /**
     * @param array $ids
     * @param IGenresProvider $repo
     * @return Collection|Model[]
     * @throws ApiErrorCodeException
     */
    private function validGenres(array $ids, IGenresProvider $repo)
    {
        $genres = $repo->getByUsedTyp($ids, ClassifiedConstant::VIDEO);
        if ($genres->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'GENRES MODEL NOT FOUND');
        }

        return $genres;
    }

    /**
     * @param int $id
     * @param IYearsProvider $repo
     * @return Model
     * @throws ApiErrorCodeException
     */
    private function validYears(int $id, IYearsProvider $repo): Model
    {
        $years = $repo->findEnableByType($id, ClassifiedConstant::VIDEO);
        if (is_null($years)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'YEARS MODEL NOT FOUND');
        }

        return $years;
    }

    /**
     * @param IRegionProvider $repo
     * @return Collection|Model[]
     */
    public function region(IRegionProvider $repo)
    {
        return $repo->getEnableByUsedType(RegionUsedTypeConstants::VIDEO);
    }

    /**
     * @param IActressProvider $repo
     * @return Collection|Model[]
     */
    public function actress(IActressProvider $repo)
    {
        return $repo->getEnableByUsedType(AVActressUsedTypeConstants::VIDEO);
    }

    /**
     * @param ICupProvider $repo
     * @return Collection|Model[]
     */
    public function cup(ICupProvider $repo)
    {
        return $repo->getEnableByUsedType(CupUsedTypeConstants::VIDEO);
    }

    /**
     * @param IGenresProvider $repo
     * @return Collection|Model[]
     */
    public function genres(IGenresProvider $repo)
    {
        return $repo->getEnableUsedType(ClassifiedConstant::VIDEO);
    }

    /**
     * @param IYearsProvider $repo
     * @return Collection|Model[]
     */
    public function years(IYearsProvider $repo)
    {
        return $repo->getEnableByType(ClassifiedConstant::VIDEO);
    }
}
