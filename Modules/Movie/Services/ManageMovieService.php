<?php

namespace Modules\Movie\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\ApiCode\OOOO4MovieCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\Genres;
use Modules\Classified\Entities\Language;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Movie\Entities\Movie;
use Modules\Movie\Http\Requests\Manage\MovieEditRequest;
use Modules\Movie\Http\Requests\Manage\MovieIndexRequest;
use Modules\Movie\Http\Requests\Manage\MovieInfoRequest;
use Modules\Movie\Http\Requests\Manage\MovieUpdateRequest;
use Modules\Movie\Repositories\MovieRepo;

class ManageMovieService
{
    /** @var MovieRepo $repo */
    private $repo;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var string $type */
    private $type;

    public function __construct(IEditorFilesProvider $editorFilesProvider)
    {
        $this->repo = app(MovieRepo::class);
        $this->editorFilesProvider = $editorFilesProvider;
        $this->type = ClassifiedConstant::MOVIE;
    }

    /**
     * @param MovieIndexRequest $request
     * @return Collection|Movie[]
     */
    public function list(MovieIndexRequest $request)
    {
        return $this->repo->list(
            $request->getName(),
            $request->getRegionId(),
            $request->getYearsId(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param MovieIndexRequest $request
     * @return int
     */
    public function total(MovieIndexRequest $request)
    {
        return $this->repo->total(
            $request->getName(),
            $request->getRegionId(),
            $request->getYearsId(),
            $request->getStatus()
        );
    }

    /**
     * @param int id
     * @return Movie|null
     */
    public function info(int $id)
    {
        return $this->repo->findById($id);
    }

    /**
     * @param MovieEditRequest $request
     * @param Cloud $cloud
     * @return Movie
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(MovieEditRequest $request, Cloud $cloud)
    {
        [$movie, $genres, $editorFiles, $attributes] = $this->handleData(app(Movie::class), $request, $cloud);
        \DB::transaction(function () use ($movie, $genres, $attributes, $editorFiles, &$result) {
            $movie = $this->repo->create($movie, $attributes);
            if (is_null($movie)) {
                throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL);
            }
            $movie->genres()->sync($genres);
            $movie->usedEditorFile($editorFiles);
            $result = $movie->load('region', 'years', 'language', 'genres', 'editorFiles');
        });

        return $result;
    }

    /**
     * @param MovieUpdateRequest $request
     * @param Cloud $cloud
     * @return Movie
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(MovieUpdateRequest $request, Cloud $cloud)
    {
        $movie = $this->info($request->getId());
        if (is_null($movie)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Movie not found');
        }
        [$movie, $genres, $editorFiles, $attributes] = $this->handleData($movie, $request, $cloud);
        \DB::transaction(function () use ($movie, $genres, $attributes, $editorFiles, &$result) {
            $movie = $this->repo->update($movie, $attributes);
            if (is_null($movie)) {
                throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
            }
            $movie->genres()->sync($genres);
            $movie->usedEditorFile($editorFiles);
            $result = $movie->load('region', 'years', 'language', 'genres', 'editorFiles');
        });

        return $result;
    }

    /**
     * @param MovieInfoRequest $request
     * @param Cloud $cloud
     * @return int
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(MovieInfoRequest $request, Cloud $cloud)
    {
        $movie = app(MovieRepo::class)->findById($request->getId());
        if (is_null($movie)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        \DB::transaction(function () use ($movie, $cloud, &$result) {
            $result = $this->repo->del($movie->getKey());
            $movie->episodes()->delete();
            $movie->genres()->detach();
            $cloud->delete($movie->image_path);
            $movie->cancelEditorFile();
        });

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
        $fullPath = $cloud->put(config('Movie.config.movie_path'), $cover, Filesystem::VISIBILITY_PUBLIC);
        if (is_bool($fullPath)) {
            throw new ApiErrorCodeException(OOOO4MovieCodes::UPLOAD_IMAGE_FAIL, 'Upload image fail');
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
     * @param int $languageId
     * @return Language
     * @throws ApiErrorCodeException
     */
    private function findLanguage(int $languageId)
    {
        $lang = app(LanguageSettingRepo::class)->findEnableByType($languageId, $this->type);
        if (is_null($lang)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'Language not found');
        }

        return $lang;
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
     * @param Movie $movie
     * @param MovieEditRequest $request
     * @param Cloud $cloud
     * @return array
     * @throws ApiErrorCodeException
     */
    private function handleData(Movie $movie, MovieEditRequest $request, Cloud $cloud)
    {
        $region = $this->findRegion($request->getRegionId());
        $year = $this->findYears($request->getYearsId());
        $lang = $this->findLanguage($request->getLanguageId());
        $genres = $this->findGenres($request->getGenreIds());
        $editorFiles = $this->editorFilesProvider->getByIds($request->getImageIds());
        $attributes = [
            'name'           => $request->getName(),
            'alias'          => $request->getAlias(),
            'starring'       => $request->getStarring(),
            'episode_status' => $request->getEpisodeStatus(),
            'director'       => $request->getDirector(),
            'description'    => $request->getDescription(),
            'views'          => $request->getViews(),
            'score'          => $request->getScore(),
            'status'         => $request->getStatus()
        ];
        $cover = $request->getCover();
        if ($request instanceof MovieUpdateRequest) {
            if ($request->getRemoveCover()) {
                $cloud->delete($movie->image_path);
                $movie->image_path = null;
                $movie->image_url = null;
            }
            if (!is_null($cover)) {
                $cloud->delete($movie->image_path);
            }
        }
        if (!is_null($cover)) {
            $path = $this->uploadCover($cover, $cloud);
            $attributes['image_path'] = $path;
            $attributes['image_url'] = $cloud->url($path);
        }
        $movie->region()->associate($region);
        $movie->years()->associate($year);
        $movie->language()->associate($lang);

        return [$movie, $genres, $editorFiles, $attributes];
    }
}
