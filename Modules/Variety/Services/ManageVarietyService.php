<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/17
 * Time: 下午 05:27
 */

namespace Modules\Variety\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Variety\Entities\Variety;
use Modules\Variety\Http\Requests\GetIdRequestHandle;
use Modules\Variety\Http\Requests\ListRequestHandle;
use Modules\Variety\Http\Requests\StoreRequestHandle;
use Modules\Variety\Http\Requests\UpdateRequestHandle;
use Modules\Variety\Repositories\VarietyRepo;

class ManageVarietyService
{
    /** @var Cloud $storage */
    private $storage;
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var VarietyRepo $repo */
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
     * ManageVarietyService constructor.
     * @param Cloud $storage
     * @param IEditorFilesProvider $editorFilesProvider
     */
    public function __construct(Cloud $storage, IEditorFilesProvider $editorFilesProvider)
    {
        $this->type = ClassifiedConstant::VARIETY;
        $this->storage = $storage;
        $this->editorFilesProvider = $editorFilesProvider;
        $this->repo = new VarietyRepo();
        $this->regionRepo = new RegionRepo();
        $this->genreRepo = new GenresSettingRepo();
        $this->yearRepo = new YearsSettingRepo();
        $this->languageRepo = new LanguageSettingRepo();
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Variety\Entities\Variety[]
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
     * @return Variety|null
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
            $request->getHost(),
            $request->getGuest(),
            $request->getDescription(),
            $imagePath,
            $request->getEditorImageIds(),
            $request->getViews(),
            $request->getScore()
        );
        \DB::transaction(function () use ($editProcess, &$result) {
            $variety = $this->repo->create($editProcess->get('attributes'));
            $variety->genres()->attach($editProcess->get('genre'));
            $variety->usedEditorFile($editProcess->get('editor_files'));
            $result = $variety->load(['years', 'region', 'language', 'genres', 'editorFiles']);
        });

        return $result;
    }

    public function edit(GetIdRequestHandle $request)
    {
        return $this->repo->find($request->getId())->load(['years', 'region', 'language', 'genres', 'editorFiles']);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return Variety|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        $result = null;
        $imagePath = null;
        $variety = $this->repo->find($request->getId());
        if (is_null($variety)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        if ($request->getRemoveImage()) {
            $this->storage->delete($variety->image_path);
            $variety->image_path = null;
        }
        if (!is_null($request->getImage())) {
            $this->storage->delete($variety->image_path);
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
            $request->getHost(),
            $request->getGuest(),
            $request->getDescription(),
            $imagePath ?? $variety->image_path,
            $request->getEditorImageIds(),
            $request->getViews(),
            $request->getScore()
        );
        \DB::transaction(function () use ($variety, $editProcess, &$result) {
            $variety->update($editProcess->get('attributes'));
            $variety->genres()->sync($editProcess->get('genre'));
            $variety->usedEditorFile($editProcess->get('editor_files'));
            $result = $variety->load(['years', 'region', 'language', 'genres', 'editorFiles']);
        });

        return $result;
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Variety|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(GetIdRequestHandle $request)
    {
        $result = null;
        $variety = $this->repo->find($request->getId());
        if (is_null($variety)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        \DB::transaction(function () use ($variety, &$result) {
            $this->storage->delete($variety->image_path);
            $variety->genres()->detach();
            $variety->cancelEditorFile();
            $this->repo->delete($variety);
            $result = $variety;
        });

        return $result;
    }

    /**
     * @param UploadedFile $image
     * @return bool
     */
    private function uploadImage(UploadedFile $image)
    {
        $path = config('Variety.config.file_path');

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
     * @param string|null $host
     * @param string|null $guest
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
        string $host = null,
        string $guest = null,
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
            'host'           => $host,
            'guest'          => $guest,
            'description'    => $description,
            'image_path'     => $imagePath,
            'image_url'      => $imagePath ? $this->storage->url($imagePath) : null,
            'region_id'      => $region->getKey(),
            'years_id'       => $year->getKey(),
            'language_id'    => $language->getKey(),
            'views'          => $views,
            'score'          => $score
        ];

        return collect(['attributes' => $attributes, 'genre' => $genre, 'editor_files' => $editorFiles]);
    }
}
