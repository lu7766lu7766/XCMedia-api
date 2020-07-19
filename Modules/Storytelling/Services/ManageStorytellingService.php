<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/11
 * Time: 下午 03:33
 */

namespace Modules\Storytelling\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Storytelling\Entities\Storytelling;
use Modules\Storytelling\Entities\StorytellingAudio;
use Modules\Storytelling\Http\Requests\Manage\Storytelling\GetIdRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\Storytelling\ListRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\Storytelling\StoreRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\Storytelling\UpdateRequestHandle;
use Modules\Storytelling\Repositories\StorytellingRepo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ManageStorytellingService
{
    /** @var IEditorFilesProvider $editorFilesProvider */
    private $editorFilesProvider;
    /** @var StorytellingRepo $repo */
    private $repo;
    /** @var $regionRepo RegionRepo */
    private $regionRepo;
    /** @var GenresSettingRepo $genreRepo */
    private $genreRepo;
    /** @var YearsSettingRepo $yearRepo */
    private $yearRepo;
    /** @var string $type */
    private $type;

    /**
     * ManageStorytellingService constructor.
     * @param IEditorFilesProvider $editorFilesProvider
     */
    public function __construct(IEditorFilesProvider $editorFilesProvider)
    {
        $this->type = ClassifiedConstant::STORYTELLING;
        $this->editorFilesProvider = $editorFilesProvider;
        $this->repo = new StorytellingRepo();
        $this->regionRepo = new RegionRepo();
        $this->genreRepo = new GenresSettingRepo();
        $this->yearRepo = new YearsSettingRepo();
    }

    /**
     * @param StoreRequestHandle $request
     * @param Cloud $cloud
     * @return Storytelling|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function create(StoreRequestHandle $request, Cloud $cloud)
    {
        $result = null;
        $imagePath = null;
        if (!is_null($request->getCover())) {
            $imagePath = $this->upload($request->getCover(), config('Storytelling.config.cover_path'), $cloud);
        }
        $editProcess = $this->editProcess(
            $cloud,
            $request->getRegionId(),
            $request->getGenresIds(),
            $request->getYearsId(),
            $request->getTitle(),
            $request->getStatus(),
            $request->getAlias(),
            $request->getDescription(),
            $request->getTags(),
            $imagePath,
            $request->getEditorImageIds(),
            $request->getViews(),
            $request->getScore()
        );
        \DB::transaction(function () use ($editProcess, &$result) {
            $storytelling = $this->repo->create($editProcess->get('attributes'));
            $storytelling->genres()->attach($editProcess->get('genre'));
            $storytelling->usedEditorFile($editProcess->get('editor_files'));
            $result = $storytelling->load(['years', 'region', 'genres', 'editorFiles']);
        });

        return $result;
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Storytelling|null
     * @throws ApiErrorCodeException
     */
    public function info(GetIdRequestHandle $request)
    {
        $storytelling = $this->repo->find($request->getId());
        if (is_null($storytelling)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'STORYTELLING NOT FOUND');
        }

        return $storytelling->load(['years', 'region', 'genres', 'editorFiles']);
    }

    /**
     * @param ListRequestHandle $request
     * @return Collection|Storytelling[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $request->getTitle(),
            $request->getStatus(),
            $request->getYearsId(),
            $request->getRegionId(),
            $request->getPage(),
            $request->getPerpage()
        )->load(['years', 'region', 'genres', 'editorFiles']);
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
            $request->getYearsId(),
            $request->getRegionId()
        );
    }

    /**
     * @param UpdateRequestHandle $request
     * @param Cloud $cloud
     * @return Storytelling|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request, Cloud $cloud)
    {
        $result = null;
        $imagePath = null;
        $storytelling = $this->repo->find($request->getId());
        if (is_null($storytelling)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        if ($request->getRemoveCover()) {
            $cloud->delete($storytelling->cover_path);
            $storytelling->cover_path = null;
            $storytelling->cover_url = null;
        }
        if (!is_null($request->getCover())) {
            $cloud->delete($storytelling->cover_path);
            $imagePath = $this->upload($request->getCover(), config('Storytelling.config.cover_path'), $cloud);
        }
        $editProcess = $this->editProcess(
            $cloud,
            $request->getRegionId(),
            $request->getGenresIds(),
            $request->getYearsId(),
            $request->getTitle(),
            $request->getStatus(),
            $request->getAlias(),
            $request->getDescription(),
            $request->getTags(),
            $imagePath ?? $storytelling->cover_path,
            $request->getEditorImageIds(),
            $request->getViews(),
            $request->getScore()
        );
        \DB::transaction(function () use ($storytelling, $editProcess, &$result) {
            $storytelling->update($editProcess->get('attributes'));
            $storytelling->genres()->sync($editProcess->get('genre'));
            $storytelling->usedEditorFile($editProcess->get('editor_files'));
            $result = $storytelling->load(['years', 'region', 'genres', 'editorFiles']);
        });

        return $result;
    }

    /**
     * @param GetIdRequestHandle $request
     * @param Cloud $cloud
     * @return Storytelling|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(GetIdRequestHandle $request, Cloud $cloud)
    {
        $result = null;
        $storytelling = $this->repo->find($request->getId());
        if (is_null($storytelling)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        \DB::transaction(function () use ($storytelling, $cloud, &$result) {
            $storytelling->audio->each(function (StorytellingAudio $audio) use ($cloud) {
                $audio->delete();
                $cloud->delete($audio->file_path);
            });
            $cloud->delete($storytelling->cover_path);
            $storytelling->genres()->detach();
            $storytelling->cancelEditorFile();
            $this->repo->delete($storytelling);
            $result = $storytelling;
        });

        return $result;
    }

    /**
     * @param IGenresProvider $repo
     * @return Collection|Model[]
     */
    public function genres(IGenresProvider $repo)
    {
        return $repo->getEnableUsedType($this->type);
    }

    /**
     * @param IRegionProvider $repo
     * @return Collection|Model[]
     */
    public function region(IRegionProvider $repo)
    {
        return $repo->getEnableByUsedType($this->type);
    }

    /**
     * @param IYearsProvider $repo
     * @return Collection|Model[]
     */
    public function years(IYearsProvider $repo)
    {
        return $repo->getEnableByType($this->type);
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     * @param Cloud $cloud
     * @return string
     * @throws ApiErrorCodeException
     */
    private function upload(UploadedFile $file, string $path, Cloud $cloud)
    {
        /** @var false|string $path */
        $path = $cloud->put($path, $file, Filesystem::VISIBILITY_PUBLIC);
        if (is_bool($path)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'UPLOAD FILE FAIL');
        }

        return $path;
    }

    /**
     * @param Cloud $cloud
     * @param int $regionId
     * @param array $genreIds
     * @param int $yearId
     * @param string $title
     * @param string $status
     * @param string|null $alias
     * @param string|null $description
     * @param array|null $tags
     * @param string|null $imagePath
     * @param array $editorImageIds
     * @return \Illuminate\Support\Collection
     * @throws ApiErrorCodeException
     */
    private function editProcess(
        Cloud $cloud,
        int $regionId,
        array $genreIds,
        int $yearId,
        string $title,
        string $status,
        string $alias = null,
        string $description = null,
        array $tags = null,
        string $imagePath = null,
        array $editorImageIds = [],
        int $views = 0,
        float $score = 0
    ) {
        $editorFiles = $this->editorFilesProvider->getByIds($editorImageIds);
        $region = $this->regionRepo->findEnableByType($regionId, $this->type);
        $genre = $this->genreRepo->getByIds($genreIds, $this->type);
        $year = $this->yearRepo->findEnableByType($yearId, $this->type);
        if (is_null($region) || $genre->isEmpty() || is_null($year)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $attributes = [
            'title'       => $title,
            'alias'       => $alias,
            'status'      => $status,
            'description' => $description,
            'tags'        => $tags,
            'cover_path'  => $imagePath,
            'cover_url'   => $imagePath ? $cloud->url($imagePath) : null,
            'region_id'   => $region->getKey(),
            'years_id'    => $year->getKey(),
            'views'       => $views,
            'score'       => $score
        ];

        return collect(['attributes' => $attributes, 'genre' => $genre, 'editor_files' => $editorFiles]);
    }
}
