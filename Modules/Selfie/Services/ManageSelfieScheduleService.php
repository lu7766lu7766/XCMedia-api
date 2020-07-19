<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/26
 * Time: 下午 07:51
 */

namespace Modules\Selfie\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Contracts\IActressProvider;
use Modules\Classified\Contracts\ICupProvider;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Selfie\Entities\SelfieSchedule;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\IndexRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\InfoRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\StoreRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\TotalRequest;
use Modules\Selfie\Http\Requests\Manage\SelfieSchedule\UpdateRequest;
use Modules\Selfie\Repositories\SelfieScheduleRepo;

class ManageSelfieScheduleService
{
    /** @var SelfieScheduleRepo $repo */
    private $repo;

    /**
     * ManageSelfieService constructor.
     * @param SelfieScheduleRepo $repo
     */
    public function __construct(SelfieScheduleRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param IndexRequest $request
     * @return Collection|SelfieSchedule[]
     */
    public function list(IndexRequest $request)
    {
        return $this->repo->book(
            $request->getIsCensored(),
            $request->getRegionId(),
            $request->getAVActressIds(),
            $request->getCupId(),
            $request->getYearsId(),
            $request->getStatus(),
            $request->getKeyword(),
            $request->getPage(),
            $request->getPerpage()
        )->load(['cup', 'years', 'region', 'actress', 'genres']);
    }

    /**
     * @param TotalRequest $request
     * @return int
     */
    public function total(TotalRequest $request)
    {
        return $this->repo->count(
            $request->getIsCensored(),
            $request->getRegionId(),
            $request->getAVActressIds(),
            $request->getCupId(),
            $request->getYearsId(),
            $request->getStatus(),
            $request->getKeyword()
        );
    }

    /**
     * @param StoreRequest $request
     * @param Cloud $cloud
     * @param IYearsProvider $yearsRepo
     * @param IRegionProvider $regionRepo
     * @param IActressProvider $actressRepo
     * @param ICupProvider $cupRepo
     * @param IGenresProvider $genresRepo
     * @return SelfieSchedule
     * @throws ApiErrorCodeException
     */
    public function create(
        StoreRequest $request,
        Cloud $cloud,
        IYearsProvider $yearsRepo,
        IRegionProvider $regionRepo,
        IActressProvider $actressRepo,
        ICupProvider $cupRepo,
        IGenresProvider $genresRepo
    ) {
        $region = $this->validRegion($request->getRegionId(), $regionRepo);
        $actress = $this->validActress($request->getAvActressIds(), $actressRepo);
        $cup = $this->validCup($request->getCupId(), $cupRepo);
        $genres = $this->validGenres($request->getGenresIds(), $genresRepo);
        $years = $this->validYears($request->getYearsId(), $yearsRepo);
        $coverPath = null;
        $coverUrl = null;
        if (!is_null($request->getCover())) {
            $coverPath = $this->uploadCover($request->getCover(), $cloud);
            $coverUrl = $cloud->url($coverPath);
        }
        try {
            $schedule = new SelfieSchedule([
                'title'       => $request->getTitle(),
                'cover_path'  => $coverPath,
                'cover_url'   => $coverUrl,
                'alias'       => $request->getAlias(),
                'is_censored' => $request->getIsCensored(),
                'tags'        => $request->getTags(),
                'description' => $request->getDescription(),
                'status'      => $request->getStatus(),
                'views'       => $request->getViews(),
                'score'       => $request->getScore()
            ]);
            \DB::transaction(function () use (
                $cup,
                $years,
                $region,
                $actress,
                $genres,
                $schedule
            ) {
                $schedule->cup()->associate($cup);
                $schedule->years()->associate($years);
                $schedule->region()->associate($region);
                $schedule->push();
                $schedule->actress()->attach($actress);
                $schedule->genres()->attach($genres);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw  new  ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL);
        }

        return $schedule;
    }

    /**
     * @param InfoRequest $request
     * @return SelfieSchedule
     * @throws ApiErrorCodeException
     */
    public function info(InfoRequest $request)
    {
        $schedule = $this->repo->find($request->getId());
        if (is_null($schedule)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'SCHEDULE NOT FOUND');
        }

        return $schedule->load(['cup', 'years', 'region', 'actress', 'genres']);
    }

    /**
     * @param int $int
     * @param IYearsProvider $repo
     * @return Model|null
     * @throws ApiErrorCodeException
     */
    private function validYears(int $int, IYearsProvider $repo)
    {
        $years = $repo->findEnableByType($int, $this->alias());
        if (is_null($years)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'YEARS NOT FOUND');
        }

        return $years;
    }

    /**
     * @param int $id
     * @param IRegionProvider $repo
     * @return Model|null
     * @throws ApiErrorCodeException
     */
    private function validRegion(int $id, IRegionProvider $repo)
    {
        $region = $repo->findEnableByType($id, $this->alias());
        if (is_null($region)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'REGION NOT FOUND');
        }

        return $region;
    }

    /**
     * @return string
     */
    private function alias(): string
    {
        return ClassifiedConstant::SELFIE;
    }

    /**
     * @param array $ids
     * @param IActressProvider $repo
     * @return Collection|Model[]
     * @throws ApiErrorCodeException
     */
    private function validActress(array $ids, IActressProvider $repo)
    {
        $actresses = $repo->findEnableByUsedType($ids, $this->alias());
        if ($actresses->isEmpty()) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'AV ACTRESS NOT FOUND');
        }

        return $actresses;
    }

    /**
     * @param int $id
     * @param ICupProvider $repo
     * @return Model|null
     * @throws ApiErrorCodeException
     */
    private function validCup(int $id, ICupProvider $repo)
    {
        $cup = $repo->findByUsedType($this->alias(), $id);
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
    private function validGenres(array $ids, IGenresProvider $repo)
    {
        $genres = $repo->getByUsedTyp($ids, $this->alias());
        if ($genres->isEmpty()) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'GENRES NOT FOUND');
        }

        return $genres;
    }

    /**
     * @param UpdateRequest $request
     * @param Cloud $cloud
     * @param IYearsProvider $yearsRepo
     * @param IRegionProvider $regionRepo
     * @param IActressProvider $actressRepo
     * @param ICupProvider $cupRepo
     * @param IGenresProvider $genresRepo
     * @return SelfieSchedule
     * @throws ApiErrorCodeException
     */
    public function update(
        UpdateRequest $request,
        Cloud $cloud,
        IYearsProvider $yearsRepo,
        IRegionProvider $regionRepo,
        IActressProvider $actressRepo,
        ICupProvider $cupRepo,
        IGenresProvider $genresRepo
    ) {
        $schedule = $this->repo->find($request->getId());
        if (is_null($schedule)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'SCHEDULE NOT FOUND');
        }
        $region = $this->validRegion($request->getRegionId(), $regionRepo);
        $actress = $this->validActress($request->getAvActressIds(), $actressRepo);
        $cup = $this->validCup($request->getCupId(), $cupRepo);
        $genres = $this->validGenres($request->getGenresIds(), $genresRepo);
        $years = $this->validYears($request->getYearsId(), $yearsRepo);
        $attribute = [
            'title'       => $request->getTitle(),
            'alias'       => $request->getAlias(),
            'is_censored' => $request->getIsCensored(),
            'tags'        => $request->getTags(),
            'description' => $request->getDescription(),
            'status'      => $request->getStatus(),
            'views'       => $request->getViews(),
            'score'       => $request->getScore()
        ];
        if ($request->getRemoveCover()) {
            $cloud->delete($schedule->cover_path);
            $schedule->cover_path = null;
            $schedule->cover_url = null;
        }
        if (!is_null($request->getCover())) {
            $coverPath = $this->uploadCover($request->getCover(), $cloud);
            $attribute['cover_path'] = $coverPath;
            $attribute['cover_url'] = $cloud->url($coverPath);
            if (!is_null($schedule->cover_path)) {
                $cloud->delete($schedule->cover_path);
            }
        }
        try {
            $schedule->fill($attribute);
            \DB::transaction(function () use ($schedule, $actress, $genres, $cup, $years, $region) {
                $schedule->actress()->sync($actress);
                $schedule->genres()->sync($genres);
                $schedule->cup()->associate($cup);
                $schedule->years()->associate($years);
                $schedule->region()->associate($region);
                $schedule->push();
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            throw  new ApiErrorCodeException(OOOO1CommonCodes::UPDATE_FAIL);
        }

        return $schedule;
    }

    /**
     * @param UploadedFile $file
     * @param Cloud $cloud
     * @return string
     * @throws ApiErrorCodeException
     */
    private function uploadCover(UploadedFile $file, Cloud $cloud)
    {
        /** @var string|false $path */
        $path = $cloud->put(
            config('Selfie.config.cover_path'),
            $file,
            $cloud::VISIBILITY_PUBLIC
        );
        if (is_bool($path)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'UPLOAD COVER FAIL');
        }

        return $path;
    }

    /**
     * @param InfoRequest $request
     * @param Cloud $cloud
     * @return SelfieSchedule
     * @throws ApiErrorCodeException
     */
    public function delete(InfoRequest $request, Cloud $cloud)
    {
        $schedule = $this->repo->find($request->getId());
        if (is_null($schedule)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        if (!is_null($path = $schedule->cover_path)) {
            $cloud->delete($path);
        }
        try {
            \DB::transaction(function () use ($schedule) {
                $schedule->genres()->detach();
                $schedule->actress()->detach();
                $schedule->delete();
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $schedule;
    }

    /**
     * @param IGenresProvider $repo
     * @return Collection|Model[]
     */
    public function genres(IGenresProvider $repo)
    {
        return $repo->getEnableUsedType($this->alias());
    }

    /**
     * @param IRegionProvider $repo
     * @return Collection|Model[]
     */
    public function region(IRegionProvider $repo)
    {
        return $repo->getEnableByUsedType($this->alias());
    }

    /**
     * @param IActressProvider $repo
     * @return Collection|Model[]
     */
    public function actress(IActressProvider $repo)
    {
        return $repo->getEnableByUsedType($this->alias());
    }

    /**
     * @param ICupProvider $repo
     * @return Collection|Model[]
     */
    public function cup(ICupProvider $repo)
    {
        return $repo->getEnableByUsedType($this->alias());
    }

    /**
     * @param IYearsProvider $repo
     * @return Collection|Model[]
     */
    public function years(IYearsProvider $repo)
    {
        return $repo->getEnableByType($this->alias());
    }
}
