<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 02:33
 */

namespace Modules\ShortFilm\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\AVActressRepo;
use Modules\Classified\Repositories\CupRepo;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Files\Repositories\EditorFilesRepo;
use Modules\ShortFilm\Entities\ShortFilm;
use Modules\ShortFilm\Http\Requests\AddRequestHandle;
use Modules\ShortFilm\Http\Requests\DeleteRequestHandle;
use Modules\ShortFilm\Http\Requests\EditRequestHandle;
use Modules\ShortFilm\Http\Requests\EditVideoRequestHandle;
use Modules\ShortFilm\Http\Requests\ListRequestHandle;
use Modules\ShortFilm\Http\Requests\TotalRequestHandle;
use Modules\ShortFilm\Repositories\ShortFilmRepo;

class ManageShortFilmService
{
    /** @var ShortFilmRepo $repo */
    private $repo;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var string $type */
    private $type;

    /**
     * ManageShortFilmService constructor.
     * @param ShortFilmRepo $repo
     * @param IEditorFilesProvider $editorFilesProvider
     */
    public function __construct(ShortFilmRepo $repo, IEditorFilesProvider $editorFilesProvider)
    {
        $this->repo = $repo;
        $this->editorFilesProvider = $editorFilesProvider;
        $this->type = ClassifiedConstant::SHORT_FILM;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\ShortFilm\Entities\ShortFilm[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->list(
            $request->getMosaicType(),
            $request->getRegionId(),
            $request->getAvActressIds(),
            $request->getGenresIds(),
            $request->getCupId(),
            $request->getYearId(),
            $request->getStatus(),
            $request->getTitle(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param TotalRequestHandle $request
     * @return int
     */
    public function total(TotalRequestHandle $request)
    {
        return $this->repo->total(
            $request->getMosaicType(),
            $request->getRegionId(),
            $request->getAvActressIds(),
            $request->getGenresIds(),
            $request->getCupId(),
            $request->getYearId(),
            $request->getStatus(),
            $request->getTitle()
        );
    }

    /**
     * @param AddRequestHandle $request
     * @param Cloud $cloud
     * @return ShortFilm
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function add(AddRequestHandle $request, Cloud $cloud)
    {
        $model = app(ShortFilm::class);

        return $this->sync(
            $model,
            $cloud,
            $request->getTitle(),
            $request->getMosaicType(),
            $request->getImageIds(),
            $request->getGenresIds(),
            $request->getAVActressIds(),
            $request->getRegionId(),
            $request->getCupId(),
            $request->getYearId(),
            $request->getStatus(),
            $request->getAlias(),
            $request->getTags(),
            $request->getDescription(),
            $request->getCover(),
            false,
            $request->getViews(),
            $request->getScore()
        );
    }

    /**
     * @param EditRequestHandle $request
     * @param Cloud $cloud
     * @return ShortFilm|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function edit(EditRequestHandle $request, Cloud $cloud)
    {
        $model = $this->findShortFilm($request->getId());

        return $this->sync(
            $model,
            $cloud,
            $request->getTitle(),
            $request->getMosaicType(),
            $request->getImageIds(),
            $request->getGenresIds(),
            $request->getAVActressIds(),
            $request->getRegionId(),
            $request->getCupId(),
            $request->getYearId(),
            $request->getStatus(),
            $request->getAlias(),
            $request->getTags(),
            $request->getDescription(),
            $request->getCover(),
            $request->getRemoveCover(),
            $request->getViews(),
            $request->getScore()
        );
    }

    /**
     * @param EditVideoRequestHandle $request
     * @param Cloud $cloud
     * @return ShortFilm|null
     * @throws ApiErrorCodeException
     */
    public function video(EditVideoRequestHandle $request, Cloud $cloud)
    {
        $model = $this->findShortFilm($request->getId());
        $attributes = [
            'open_at'      => $request->getOpenAt(),
            'video_status' => $request->getVideoStatus()
        ];
        if ($request->getRemoveVideo()) {
            $cloud->delete($model->video_path);
            $model->video_path = null;
            $model->video_url = null;
        }
        if (!is_null($request->getVideo())) {
            $cloud->delete($model->video_path);
            $model->video_path = $this->uploadFile($cloud, $request->getVideo(), 'video');
            $model->video_url = $cloud->url($model->video_path);
        }
        $result = $this->repo->update($model, $attributes);
        if (is_null($request)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'Short film update failed.');
        }

        return $result;
    }

    /**
     * @param ShortFilm $model
     * @param Cloud $cloud
     * @param string $title
     * @param string $mosaicType
     * @param array $imageIds
     * @param array $genresIds
     * @param array $avActressIds
     * @param int $regionId
     * @param int $cupId
     * @param int $yearId
     * @param string $status
     * @param null|string $alias
     * @param null|string $tags
     * @param null|string $description
     * @param UploadedFile|null $cover
     * @param bool $removeCover
     * @param int $views
     * @param float $score
     * @return ShortFilm
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    private function sync(
        ShortFilm $model,
        Cloud $cloud,
        string $title,
        string $mosaicType,
        array $imageIds,
        array $genresIds,
        array $avActressIds,
        int $regionId,
        int $cupId,
        int $yearId,
        string $status,
        ?string $alias,
        ?string $tags,
        ?string $description,
        ?UploadedFile $cover,
        bool $removeCover = false,
        int $views = 0,
        float $score = 0
    ) {
        $attributes = [
            'title'       => $title,
            'alias'       => $alias,
            'mosaic_type' => $mosaicType,
            'tags'        => $tags,
            'description' => $description,
            'status'      => $status,
            'views'       => $views,
            'score'       => $score
        ];
        $region = $this->findRegion($regionId);
        $cup = $this->findCup($cupId);
        $year = $this->findYears($yearId);
        $genresIds = $this->filterGenres($genresIds);
        $avActressIds = $this->filterAVActress($avActressIds);
        $imageIds = $this->filterEditorImages($imageIds);
        if ($removeCover) {
            $cloud->delete($model->cover_path);
            $model->cover_path = null;
            $model->cover_url = null;
        }
        if (!is_null($cover)) {
            $cloud->delete($model->cover_path);
            $model->cover_path = $this->uploadFile($cloud, $cover, 'image');
            $model->cover_url = $cloud->url($model->cover_path);
        }
        $result = null;
        \DB::transaction(function () use (
            $model,
            $attributes,
            $region,
            $cup,
            $year,
            $genresIds,
            $avActressIds,
            $imageIds,
            &$result
        ) {
            $this->repo->fill($model, $attributes);
            $model->region()->associate($region);
            $model->cup()->associate($cup);
            $model->year()->associate($year);
            $model->save();
            $model->genres()->sync($genresIds);
            $model->avActress()->sync($avActressIds);
            empty($imageIds) ? null : $model->editorFiles()->sync($imageIds);
            $result = $model;
        });
        if (is_null($model)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'Short film sync failed.');
        }

        return $model;
    }

    /**
     * @param DeleteRequestHandle $request
     * @param Cloud $cloud
     * @return ShortFilm
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(DeleteRequestHandle $request, Cloud $cloud)
    {
        $shortFilm = $this->findShortFilm($request->getId());
        /** @var ShortFilm $result */
        $result = null;
        \DB::transaction(function () use ($shortFilm, &$result) {
            $result = $this->repo->delete($shortFilm);
            $shortFilm->genres()->detach();
            $shortFilm->avActress()->detach();
            $editorFilesIds = $shortFilm->editorFiles()->pluck('editor_files.id')->toArray();
            $shortFilm->editorFiles()->detach();
            $unusedEditorFilesIds = $this->editorFilesProvider->getUnusedByIds($editorFilesIds)->pluck('id')->toArray();
            $this->editorFilesProvider->deleteByIds($unusedEditorFilesIds);
        });
        $coverPath = $shortFilm->getAttribute('cover_path');
        is_null($coverPath) ? null : $cloud->delete($coverPath);
        $videoPath = $shortFilm->getAttribute('video_path');
        is_null($videoPath) ? null : $cloud->delete($videoPath);

        return $result;
    }

    /**
     * @param Cloud $cloud
     * @param UploadedFile $file
     * @param string $type
     * @return bool
     * @throws ApiErrorCodeException
     */
    private function uploadFile(Cloud $cloud, UploadedFile $file, string $type)
    {
        switch ($type) {
            case 'video':
                $uploadPath = config('ShortFilm.config.short_film_video_path');
                break;
            case 'image':
                $uploadPath = config('ShortFilm.config.short_film_cover_path');
                break;
            default:
                throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'Undefined file type.');
        }
        $filePath = $cloud->put($uploadPath, $file, Filesystem::VISIBILITY_PUBLIC);
        if (is_bool($filePath)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'File upload failed.');
        }

        return $filePath;
    }

    /**
     * @param int $id
     * @param string|null $status
     * @return ShortFilm|null
     * @throws ApiErrorCodeException
     */
    private function findShortFilm(int $id, string $status = null)
    {
        $result = $this->repo->find($id, $status);
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Short film not found.');
        }

        return $result;
    }

    /**
     * @param int $id
     * @return \Modules\Classified\Entities\Years|null
     * @throws ApiErrorCodeException
     */
    private function findYears(int $id)
    {
        $result = app(YearsSettingRepo::class)->findEnableByType($id, $this->type);
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Year not found.');
        }

        return $result;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|RegionRepo|null|object
     * @throws ApiErrorCodeException
     */
    private function findRegion(int $id)
    {
        $result = app(RegionRepo::class)->findEnableByType($id, $this->type);
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Region not found.');
        }

        return $result;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Cup[]
     * @throws ApiErrorCodeException
     */
    private function findCup(int $id)
    {
        $result = app(CupRepo::class)->getEnableByUsedType($this->type)->where('id', $id)->first();
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Cup not found.');
        }

        return $result;
    }

    /**
     * @param array $ids
     * @return array
     */
    private function filterGenres(array $ids)
    {
        return app(GenresSettingRepo::class)->getByIds($ids, $this->type, NYEnumConstants::YES)->pluck('id')->toArray();
    }

    /**
     * @param array $ids
     * @return array
     */
    private function filterAVActress(array $ids)
    {
        return app(AVActressRepo::class)->findEnableByUsedType($ids, $this->type)->pluck('id')->toArray();
    }

    /**
     * @param array $ids
     * @return array
     */
    private function filterEditorImages(array $ids)
    {
        return app(EditorFilesRepo::class)->getByIds($ids, NYEnumConstants::YES)->pluck('id')->toArray();
    }
}
