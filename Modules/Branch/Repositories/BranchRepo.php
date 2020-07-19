<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/2
 * Time: 下午 04:29
 */

namespace Modules\Branch\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Branch\Contracts\IBranchProvider;
use Modules\Branch\Entities\Branch;

class BranchRepo implements IBranchProvider
{
    /**
     * @return Branch[]|Collection
     */
    public function getEnable()
    {
        try {
            $result = Branch::where('status', NYEnumConstants::YES)
                ->orderByDesc('id')
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $name
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Branch[]|Collection
     */
    public function get(
        string $name = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Branch::query();
            if (!is_null($name)) {
                $query->where('name', 'like', "%{$name}%");
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $name
     * @param string|null $status
     * @return int
     */
    public function count(
        string $name = null,
        string $status = null
    ) {
        try {
            $query = Branch::query();
            if (!is_null($name)) {
                $query->where('name', 'like', "%{$name}%");
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return Branch|null
     */
    public function find(int $id)
    {
        try {
            $result = Branch::find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return Branch|null
     */
    public function create(array $attributes)
    {
        try {
            $result = Branch::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Branch $branch
     * @param array $attributes
     * @return Branch|null
     */
    public function update(Branch $branch, array $attributes)
    {
        try {
            $branch->update($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $branch;
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        try {
            $result = Branch::where('id', $id)->delete();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getByIds(array $ids)
    {
        try {
            $result = Branch::whereIn('id', $ids)
                ->where('status', NYEnumConstants::YES)
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $domain
     * @param string $status
     * @param string $isRegister
     * @return Model|null
     */
    public function findByDomain(
        string $domain,
        string $status = NYEnumConstants::YES,
        string $isRegister = NYEnumConstants::YES
    ) {
        try {
            $branch = Branch::where('domain', $domain)
                ->where('status', $status)
                ->where('is_register', $isRegister)
                ->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $branch = null;
        }

        return $branch;
    }

    /**
     * @return Collection|Branch[]
     */
    public function all()
    {
        try {
            $result = Branch::all();
        } catch (\Throwable $e) {
            $result = Collection::make();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $domain
     * @return Branch|null
     */
    public function firstByDomain(string $domain)
    {
        try {
            $branch = Branch::where('domain', $domain)->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $branch = null;
        }

        return $branch;
    }
}
