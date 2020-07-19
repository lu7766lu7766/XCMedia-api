<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/14
 * Time: 下午 04:46
 */

namespace Modules\Anime\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Modules\Anime\Entities\Anime;
use Modules\Anime\Http\Requests\GetIdRequestHandle;
use Modules\Anime\Http\Requests\ListRequestHandle;
use Modules\Anime\Http\Requests\StoreRequestHandle;
use Modules\Anime\Http\Requests\UpdateRequestHandle;
use Modules\Anime\Repositories\AnimeRepo;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Files\Contracts\IEditorFilesProvider;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ManageAnimeService
{
    /** @var Cloud $storage */
    private $storage;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var AnimeRepo $repo */
    private $repo;
    /** @var $regionRepo RegionRepo */
    private $regionRepo;
    /** @var GenresSettingRepo $genreRepo */
    private $genreRepo;
    /** @var YearsSettingRepo $yearRepo */
    private $yearRepo;
    /** @var LanguageSettingRepo $languageRepo */
    private $languageRepo;
    /** @var string $type */
    private $type;

    /**
     * ManageDramaService constructor.
     * @param Cloud $storage
     * @param IEditorFilesProvider $editorFilesProvider
     */
    public function __construct(Cloud $storage, IEditorFilesProvider $editorFilesProvider)
    {
        $this->type = ClassifiedConstant::ANIME;
        $this->storage = $storage;
        $this->editorFilesProvider = $editorFilesProvider;
        $this->repo = new AnimeRepo();
        $this->regionRepo = new RegionRepo();
        $this->genreRepo = new GenresSettingRepo();
        $this->yearRepo = new YearsSettingRepo();
        $this->languageRepo = new LanguageSettingRepo();
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|Anime[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $request->getTitle(),
            $request->getStatus(),
            $request->getEpisodeStatus(),
            $request->getYearsId(),
            $request->getRegionId(),
            $request->getPage(),
            $request->getPerpage()
        )->load(['years', 'region', 'language', 'genres', 'editorFiles']);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return $this->repo->count(
            $request->getTitle(),
            $request->getStatus(),
            $request->getEpisodeStatus(),
            $request->getYearsId(),
            $request->getRegionId()
        );
    }

    /**
     * @param StoreRequestHandle $request
     * @return Anime|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function create(StoreRequestHandle $request)
    {
        $result = null;
        $imagePath = null;
        if (!is_null($request->getImage())) {
            $imagePath = $this->uploadImage($request->getImage());
        }
        $editProcess = $this->editProcess(
            $request->getRegionId(),
            $request->getGenreIds(),
            $request->getYearsId(),
            $request->getLanguageId(),
            $request->getTitle(),
            $request->getEpisodeStatus(),
            $request->getStatus(),
            $request->getAlias(),
            $request->getStarring(),
            $request->getDirector(),
            $request->getDescription(),
            $imagePath,
            $request->getEditorImageIds(),
            $request->getViews(),
            $request->getScore()
        );
        \DB::transaction(function () use ($editProcess, &$result) {
            $anime = $this->repo->create($editProcess->get('attributes'));
            $anime->genres()->attach($editProcess->get('genre'));
            $anime->usedEditorFile($editProcess->get('editor_files'));
            $result = $anime->load(['years', 'region', 'language', 'genres', 'editorFiles']);
        });

        return $result;
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Anime|null
     * @throws ApiErrorCodeException
     */
    public function edit(GetIdRequestHandle $request)
    {
        $result = $this->repo->find($request->getId());
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }

        return $result->load(['years', 'region', 'language', 'genres', 'editorFiles']);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return Anime|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        $result = null;
        $imagePath = null;
        $anime = $this->repo->find($request->getId());
        if (is_null($anime)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        if ($request->getRemoveImage()) {
            $this->storage->delete($anime->image_path);
            $anime->image_path = null;
        }
        if (!is_null($request->getImage())) {
            $this->storage->delete($anime->image_path);
            $imagePath = $this->uploadImage($request->getImage());
        }
        $editProcess = $this->editProcess(
            $request->getRegionId(),
            $request->getGenreIds(),
            $request->getYearsId(),
            $request->getLanguageId(),
            $request->getTitle(),
            $request->getEpisodeStatus(),
            $request->getStatus(),
            $request->getAlias(),
            $request->getStarring(),
            $request->getDirector(),
            $request->getDescription(),
            $imagePath ?? $anime->image_path,
            $request->getEditorImageIds(),
            $request->getViews(),
            $request->getScore()
        );
        \DB::transaction(function () use ($anime, $editProcess, &$result) {
            $anime->update($editProcess->get('attributes'));
            $anime->genres()->sync($editProcess->get('genre'));
            $anime->usedEditorFile($editProcess->get('editor_files'));
            $result = $anime->load(['years', 'region', 'language', 'genres', 'editorFiles']);
        });

        return $result;
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Anime|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(GetIdRequestHandle $request)
    {
        $result = null;
        $drama = $this->repo->find($request->getId());
        if (is_null($drama)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        \DB::transaction(function () use ($drama, &$result) {
            $this->storage->delete($drama->image_path);
            $drama->genres()->detach();
            $drama->cancelEditorFile();
            $this->repo->delete($drama);
            $result = $drama;
        });

        return $result;
    }

    /**
     * @param UploadedFile $image
     * @return bool
     */
    private function uploadImage(UploadedFile $image)
    {
        $path = config('Anime.config.file_path');

        return $this->storage->put($path, $image, Filesystem::VISIBILITY_PUBLIC);
    }

    /**
     * @param int $regionId
     * @param array $genreIds
     * @param int $yearId
     * @param int $languageId
     * @param string $title
     * @param string $episodeStatus
     * @param string $status
     * @param string|null $alias
     * @param string|null $starring
     * @param string|null $director
     * @param string|null $description
     * @param string|null $imagePath
     * @param array $editorImageIds
     * @param int $views
     * @param float $score
     * @return \Illuminate\Support\Collection
     * @throws ApiErrorCodeException
     */
    private function editProcess(
        int $regionId,
        array $genreIds,
        int $yearId,
        int $languageId,
        string $title,
        string $episodeStatus,
        string $status,
        string $alias = null,
        string $starring = null,
        string $director = null,
        string $description = null,
        string $imagePath = null,
        array $editorImageIds = [],
        int $views = 0,
        float $score = 0
    ) {
        $editorFiles = $this->editorFilesProvider->getByIds($editorImageIds);
        $region = $this->regionRepo->findEnableByType($regionId, $this->type);
        $genre = $this->genreRepo->getByIds($genreIds, $this->type);
        $year = $this->yearRepo->findEnableByType($yearId, $this->type);
        $language = $this->languageRepo->find($languageId, $this->type);
        if (is_null($region) || $genre->isEmpty() || is_null($year) || is_null($language)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'title'          => $title,
            'alias'          => $alias,
            'episode_status' => $episodeStatus,
            'status'         => $status,
            'starring'       => $starring,
            'director'       => $director,
            'description'    => $description,
            'image_path'     => $imagePath,
            'image_url'      => $imagePath ? $this->storage->url($imagePath) : null,
            'region_id'      => $region->getKey(),
            'years_id'       => $year->getKey(),
            'language_id'    => $language->getKey(),
            'views'          => $views,
            'score'          => $score,
        ];

        return collect(['attributes' => $attributes, 'genre' => $genre, 'editor_files' => $editorFiles]);
    }
}
