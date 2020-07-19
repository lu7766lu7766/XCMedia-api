<?php

namespace Modules\Comic\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\Genres;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Comic\Entities\Comic;
use Modules\Comic\Entities\ComicEpisode;
use Modules\Comic\Entities\ComicGallery;
use Modules\Comic\Http\Requests\Manage\ComicEditRequest;
use Modules\Comic\Http\Requests\Manage\ComicIndexRequest;
use Modules\Comic\Http\Requests\Manage\ComicInfoRequest;
use Modules\Comic\Http\Requests\Manage\ComicUpdateRequest;
use Modules\Comic\Repositories\ComicRepo;
use Modules\Files\Contracts\IEditorFilesProvider;

class ManageComicService
{
    /**
     * ManageComicService constructor.
     * @param IEditorFilesProvider $editorFilesProvider
     */
    public function __construct(IEditorFilesProvider $editorFilesProvider)
    {
        $this->repo = app(ComicRepo::class);
        $this->editorFilesProvider = $editorFilesProvider;
        $this->type = ClassifiedConstant::COMIC;
    }

    /** @var ComicRepo $repo */
    private $repo;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var string $type */
    private $type;

    /**
     * @param ComicIndexRequest $request
     * @return Collection|Comic[]
     */
    public function list(ComicIndexRequest $request)
    {
        return $this->repo->list(
            $request->getName(),
            $request->getRegionId(),
            $request->getYearsId(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        )->load(['region', 'years', 'genres', 'editorFiles']);
    }

    /**
     * @param ComicIndexRequest $request
     * @return int
     */
    public function total(ComicIndexRequest $request)
    {
        return $this->repo->total(
            $request->getName(),
            $request->getRegionId(),
            $request->getYearsId(),
            $request->getStatus()
        );
    }

    /**
     * @param int $id
     * @return Comic|null
     */
    public function info(int $id)
    {
        return $this->repo->findById($id)
            ->load(['region', 'years', 'genres', 'editorFiles']);
    }

    /**
     * @param ComicEditRequest $request
     * @param Cloud $cloud
     * @return Comic
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(ComicEditRequest $request, Cloud $cloud)
    {
        [$comic, $genres, $editorFiles] = $this->handleData(app(Comic::class), $request, $cloud);
        try {
            \DB::transaction(function () use ($comic, $genres, $editorFiles) {
                /**@var Comic $comic */
                $comic->save();
                $comic->genres()->sync($genres);
                $comic->usedEditorFile($editorFiles);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL);
        }

        return $comic->load('region', 'years', 'genres', 'editorFiles');
    }

    /**
     * @param ComicUpdateRequest $request
     * @param Cloud $cloud
     * @return Comic
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(ComicUpdateRequest $request, Cloud $cloud)
    {
        $comic = $this->info($request->getId());
        if (is_null($comic)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Comic not found');
        }
        [$comic, $genres, $editorFiles] = $this->handleData($comic, $request, $cloud);
        try {
            \DB::transaction(function () use ($comic, $genres, $editorFiles) {
                /**@var Comic $comic */
                $comic->save();
                $comic->genres()->sync($genres);
                $comic->usedEditorFile($editorFiles);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $comic->load('region', 'years', 'genres', 'editorFiles');
    }

    /**
     * @param ComicInfoRequest $request
     * @param Cloud $cloud
     * @return int
     * @throws ApiErrorCodeException
     */
    public function delete(ComicInfoRequest $request, Cloud $cloud)
    {
        $comic = app(ComicRepo::class)->findById($request->getId());
        if (is_null($comic)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        try {
            \DB::transaction(function () use ($comic, $cloud, &$result) {
                $comic->episodes->each(function (ComicEpisode $episode) use ($cloud) {
                    $episode->gallery->each(function (ComicGallery $gallery) use ($cloud) {
                        $gallery->delete();
                        $cloud->delete($gallery->file_path);
                    });
                });
                $result = $this->repo->del($comic->getKey());
                $comic->genres()->detach();
                $cloud->delete($comic->image_path);
                $comic->cancelEditorFile();
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $result;
    }

    /**
     * @param UploadedFile $cover
     * @param Cloud $cloud
     * @return string
     * @throws ApiErrorCodeException
     */
    private function uploadCover(UploadedFile $cover, Cloud $cloud)
    {
        $fullPath = $cloud->put(config('Comic.config.comic_path'), $cover, Filesystem::VISIBILITY_PUBLIC);
        if (is_bool($fullPath)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'Upload image fail');
        }

        return $fullPath;
    }

    /**
     * @param int $regionId
     * @return Region
     * @throws ApiErrorCodeException
     */
    private function findRegion(int $regionId)
    {
        /** @var Region $region */
        $region = app(RegionRepo::class)->findEnableByType($regionId, $this->type);
        if (is_null($region)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Region not found');
        }

        return $region;
    }

    /**
     * @param int $yearsId
     * @return Years
     * @throws ApiErrorCodeException
     */
    private function findYears(int $yearsId)
    {
        $year = app(YearsSettingRepo::class)->findEnableByType($yearsId, $this->type);
        if (is_null($year)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Year not found');
        }

        return $year;
    }

    /**
     * @param array $genresId
     * @return Genres[]
     * @throws ApiErrorCodeException
     */
    private function findGenres(array $genresId)
    {
        $genres = app(GenresSettingRepo::class)->getByIds($genresId, $this->type);
        if ($genres->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Genres not found');
        }

        return $genres;
    }

    /**
     * @param Comic $comic
     * @param ComicEditRequest $request
     * @param Cloud $cloud
     * @return array
     * @throws ApiErrorCodeException
     */
    private function handleData(Comic $comic, ComicEditRequest $request, Cloud $cloud)
    {
        $region = $this->findRegion($request->getRegionId());
        $year = $this->findYears($request->getYearsId());
        $genres = $this->findGenres($request->getGenreIds());
        $editorFiles = $this->editorFilesProvider->getByIds($request->getImageIds());
        $attributes = [
            'name'           => $request->getName(),
            'alias'          => $request->getAlias(),
            'episode_status' => $request->getEpisodeStatus(),
            'tags'           => $request->getTags(),
            'description'    => $request->getDescription(),
            'status'         => $request->getStatus(),
            'views'          => $request->getViews(),
            'score'          => $request->getScore()
        ];
        $cover = $request->getCover();
        if ($request instanceof ComicUpdateRequest) {
            if ($request->getRemoveCover()) {
                $cloud->delete($comic->image_path);
                $comic->image_path = null;
                $comic->image_url = null;
            }
            if (!is_null($cover)) {
                $cloud->delete($comic->image_path);
            }
        }
        if (!is_null($cover)) {
            $path = $this->uploadCover($cover, $cloud);
            $attributes['image_path'] = $path;
            $attributes['image_url'] = $cloud->url($path);
        }
        $comic->region()->associate($region);
        $comic->years()->associate($year);
        $comic->fill($attributes);

        return [$comic, $genres, $editorFiles];
    }
}
