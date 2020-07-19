<?php

namespace Modules\Comic\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Comic\Entities\Comic;

class ComicRepo
{
    /**
     * @param string|null $name
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Collection|Comic[]
     */
    public function list(
        string $name = null,
        int $regionId = null,
        int $yearsId = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $builder = $this->getListQuery($name, $regionId, $yearsId, $status);
            $result = $builder->orderByDesc('id')
                ->forPage($page, $perpage)
                ->get();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $name
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param string|null $status
     * @return int
     */
    public function total(
        string $name = null,
        int $regionId = null,
        int $yearsId = null,
        string $status = null
    ) {
        try {
            $builder = $this->getListQuery($name, $regionId, $yearsId, $status);
            $result = $builder->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return Comic|null
     */
    public function findById(int $id)
    {
        try {
            /** @var Comic|null $result */
            $result = Comic::whereKey($id)->first();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return int
     */
    public function del(int $id)
    {
        try {
            $del = Comic::destroy($id);
            $result = $del > 0 ? $del : 0;
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $name
     * @param int|null $regionId
     * @param int|null $yearsId
     * @param string|null $status
     * @return Builder
     */
    private function getListQuery(
        string $name = null,
        int $regionId = null,
        int $yearsId = null,
        string $status = null
    ) {
        $builder = Comic::whereHas('region', function (Builder $builder) {
            $builder->where('region.used_type', ClassifiedConstant::COMIC);
        })->whereHas('years', function (Builder $builder) use ($yearsId) {
            $builder->where('years.used_type', ClassifiedConstant::COMIC);
            if (!is_null($yearsId)) {
                $builder->whereKey($yearsId);
            }
        })->whereHas('region', function (Builder $builder) use ($regionId) {
            $builder->where('region.used_type', ClassifiedConstant::COMIC);
            if (!is_null($regionId)) {
                $builder->whereKey($regionId);
            }
        });
        if (!is_null($name)) {
            $builder->where('name', 'like', "%{$name}%");
        }
        if (!is_null($status)) {
            $builder->where('status', $status);
        }

        return $builder;
    }
}
