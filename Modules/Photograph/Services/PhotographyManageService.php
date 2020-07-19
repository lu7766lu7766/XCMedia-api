<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 04:53
 */

namespace Modules\Photograph\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
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
use Modules\Photograph\Entities\PhotographAlbum;
use Modules\Photograph\Http\Requests\Photograph\ManageIndexRequest;
use Modules\Photograph\Http\Requests\Photograph\ManageInfoRequest;
use Modules\Photograph\Http\Requests\Photograph\ManageStoreRequest;
use Modules\Photograph\Http\Requests\Photograph\ManageTotalRequest;
use Modules\Photograph\Http\Requests\Photograph\ManageUpdateRequest;
use Modules\Photograph\Repositories\PhotographAlbumRepo;

class PhotographyManageService
{
    /** @var PhotographAlbumRepo $repo */
    private $repo;

    /**
     * PhotoManageService constructor.
     * @param PhotographAlbumRepo $repo
     */
    public function __construct(PhotographAlbumRepo $repo)
    {
        return $this->repo = $repo;
    }

    /**
     * @param ManageIndexRequest $request
     * @return Collection|PhotographAlbum[]
     */
    public function list(ManageIndexRequest $request)
    {
        return $this->repo->book(
            $request->getRegionId(),
            $request->getAvActressIds(),
            $request->getCupId(),
            $request->getYearsId(),
            $request->getStatus(),
            $request->getGenresId(),
            $request->getKeyword(),
            $request->getPage(),
            $request->getPerpage()
        )->load(['region', 'cup', 'years', 'genres', 'actress']);
    }

    /**
     * @param ManageTotalRequest $request
     * @return int
     */
    public function total(ManageTotalRequest $request): int
    {
        return $this->repo->count(
            $request->getRegionId(),
            $request->getAvActressIds(),
            $request->getCupId(),
            $request->getYearsId(),
            $request->getStatus(),
            $request->getGenresId(),
            $request->getKeyword()
        );
    }

    /**
     * @param ManageInfoRequest $request
     * @return PhotographAlbum
     * @throws ApiErrorCodeException
     */
    public function info(ManageInfoRequest $request): PhotographAlbum
    {
        $album = $this->repo->find($request->getId());
        if (is_null($album)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'PHOTOGRAPH ALBUM NOT FOUND');
        }

        return $album->load(['region', 'cup', 'years', 'genres', 'actress']);
    }

    /**
     * @param ManageStoreRequest $request
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @param IYearsProvider $yearsProvider
     * @param Cloud $cloud
     * @return PhotographAlbum
     * @throws ApiErrorCodeException
     */
    public function create(
        ManageStoreRequest $request,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider,
        IYearsProvider $yearsProvider,
        Cloud $cloud
    ): PhotographAlbum {
        $attribute = [
            'title'       => $request->getTitle(),
            'alias'       => $request->getAlias(),
            'tags'        => $request->getTags(),
            'description' => $request->getDescription(),
            'status'      => $request->getStatus(),
            'views'       => $request->getViews(),
            'score'       => $request->getScore()
        ];
        $region = $this->validRegion($request->getRegionId(), $regionProvider);
        $actress = $this->validActress($request->getAvActressIds(), $actressProvider);
        $cup = $this->validCup($request->getCupId(), $cupProvider);
        $genres = $this->validGenres($request->getGenresIds(), $genresProvider);
        $years = $this->validYears($request->getYearsId(), $yearsProvider);
        if (!is_null($cover = $request->getCover())) {
            $path = $this->uploadCover($cover, $cloud);
            $attribute['cover_path'] = $path;
            $attribute['cover_url'] = $cloud->url($path);
        }
        $album = new PhotographAlbum($attribute);
        try {
            \DB::transaction(function () use ($album, $region, $actress, $cup, $genres, $years) {
                $album->region()->associate($region);
                $album->cup()->associate($cup);
                $album->years()->associate($years);
                $album->push();
                $album->actress()->sync($actress);
                $album->genres()->sync($genres);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'PHOTOGRAPH ALBUM CREATE FAIL');
        }

        return $album;
    }

    /**
     * @param ManageUpdateRequest $request
     * @param IRegionProvider $regionProvider
     * @param IActressProvider $actressProvider
     * @param ICupProvider $cupProvider
     * @param IGenresProvider $genresProvider
     * @param IYearsProvider $yearsProvider
     * @param Cloud $cloud
     * @return PhotographAlbum
     * @throws ApiErrorCodeException
     */
    public function update(
        ManageUpdateRequest $request,
        IRegionProvider $regionProvider,
        IActressProvider $actressProvider,
        ICupProvider $cupProvider,
        IGenresProvider $genresProvider,
        IYearsProvider $yearsProvider,
        Cloud $cloud
    ): PhotographAlbum {
        $album = $this->repo->find($request->getId());
        if (is_null($album)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'PHOTOGRAPH ALBUM NOT FOUND');
        }
        $attribute = [
            'title'       => $request->getTitle(),
            'alias'       => $request->getAlias(),
            'tags'        => $request->getTags(),
            'description' => $request->getDescription(),
            'status'      => $request->getStatus(),
            'views'       => $request->getViews(),
            'score'       => $request->getScore()
        ];
        $region = $this->validRegion($request->getRegionId(), $regionProvider);
        $actress = $this->validActress($request->getAvActressIds(), $actressProvider);
        $cup = $this->validCup($request->getCupId(), $cupProvider);
        $genres = $this->validGenres($request->getGenresIds(), $genresProvider);
        $years = $this->validYears($request->getYearsId(), $yearsProvider);
        if ($request->getRemoveCover()) {
            $cloud->delete($album->cover_path);
            $album->cover_path = null;
            $album->cover_url = null;
        }
        if (!is_null($cover = $request->getCover())) {
            $path = $this->uploadCover($cover, $cloud);
            $attribute['cover_path'] = $path;
            $attribute['cover_url'] = $cloud->url($path);
            if (!is_null($path = $album->cover_path)) {
                $cloud->delete($path);
            }
        }
        $album->fill($attribute);
        try {
            \DB::transaction(function () use ($album, $region, $actress, $cup, $genres, $years) {
                $album->region()->associate($region);
                $album->cup()->associate($cup);
                $album->years()->associate($years);
                $album->actress()->sync($actress);
                $album->genres()->sync($genres);
                $album->push();
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'UPDATE PHOTOGRAPH ALBUM FAIL');
        }

        return $album;
    }

    /**
     * @param ManageInfoRequest $request
     * @param Cloud $cloud
     * @return PhotographAlbum
     * @throws ApiErrorCodeException
     */
    public function delete(ManageInfoRequest $request, Cloud $cloud): PhotographAlbum
    {
        $album = $this->info($request);
        if (!is_null($path = $album->cover_path)) {
            $cloud->delete($path);
        }
        try {
            \DB::transaction(function () use ($album) {
                $album->genres()->detach();
                $album->actress()->detach();
                $album->delete();
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL, 'UPDATE PHOTOGRAPH ALBUM FAIL');
        }

        return $album;
    }

    /**
     * @param int $id
     * @param IRegionProvider $repo
     * @return Model
     * @throws ApiErrorCodeException
     */
    private function validRegion(int $id, IRegionProvider $repo): Model
    {
        $region = $repo->findEnableByType($id, RegionUsedTypeConstants::PHOTOGRAPH);
        if (is_null($region)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'REGION NOT FOUND');
        }

        return $region;
    }

    /**
     * @param array $ids
     * @param IActressProvider $repo
     * @return Collection|Model[]
     * @throws ApiErrorCodeException
     */
    private function validActress(array $ids, IActressProvider $repo): Collection
    {
        $actress = $repo->findEnableByUsedType($ids, AVActressUsedTypeConstants::PHOTOGRAPH);
        if ($actress->isEmpty()) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'ACTRESS NOT FOUND');
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
        $cup = $repo->findByUsedType(CupUsedTypeConstants::PHOTOGRAPH, $id);
        if (is_null($cup)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'CUP NOT FOUND');
        }

        return $cup;
    }

    /**
     * @param array $ids
     * @param IGenresProvider $repo
     * @return Collection|Model[]
     * @throws ApiErrorCodeException
     */
    private function validGenres(array $ids, IGenresProvider $repo): Collection
    {
        $genres = $repo->getByUsedTyp($ids, ClassifiedConstant::PHOTOGRAPH);
        if ($genres->isEmpty()) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'GENRES NOT FOUND');
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
        $years = $repo->findEnableByType($id, ClassifiedConstant::PHOTOGRAPH);
        if (is_null($years)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'YEARS NOT FOUND');
        }

        return $years;
    }

    /**
     * @param UploadedFile $file
     * @param Cloud $cloud
     * @return string
     * @throws ApiErrorCodeException
     */
    private function uploadCover(UploadedFile $file, Cloud $cloud): string
    {
        /** @var false|string $path */
        $path = $cloud->put(config('Photograph.config.photograph_cover_path'), $file, $cloud::VISIBILITY_PUBLIC);
        if (is_bool($path)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'UPLOAD COVER FILE FAIL');
        }

        return $path;
    }
}
