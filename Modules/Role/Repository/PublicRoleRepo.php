<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/9
 * Time: 上午 11:06
 */

namespace Modules\Role\Repository;

use Illuminate\Support\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Role\Contract\IRoleProvider;
use Modules\Role\Entities\Role;

class PublicRoleRepo implements IRoleProvider
{
    /**
     * @param int $id
     * @return Role
     */
    public function find(int $id)
    {
        $result = null;
        try {
            $result = Role::where('public', NYEnumConstants::YES)
                ->find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string $code
     * @return Role
     */
    public function findByCode(int $id, string $code)
    {
        $result = null;
        try {
            $result = Role::where('code', $code)
                ->where('public', NYEnumConstants::YES)
                ->find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * 新增帳號
     * @param array $attribute
     * @param Role $role
     * @return bool
     */
    public function save(array $attribute, Role $role)
    {
        $result = false;
        try {
            $result = $role->fill($attribute)->save();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $enable
     * @param int $page
     * @param int $perpage
     * @return Role[]|Collection
     */
    public function getList(?string $enable, int $page = 1, int $perpage = 20)
    {
        $result = [];
        try {
            $builder = Role::query()
                ->where('public', NYEnumConstants::YES);
            if (!is_null($enable)) {
                $builder->where('enable', $enable);
            }
            $result = $builder->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * 角色總數
     * @param string|null $enable
     * @return int
     */
    public function count(?string $enable)
    {
        $result = 0;
        try {
            $builder = Role::query()
                ->where('public', NYEnumConstants::YES);
            if (!is_null($enable)) {
                $builder->where('enable', $enable);
            }
            $result = $builder->count('id');
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * Delete successful and the effect row count will return ,otherwise 0.
     * @param int $id
     * @param string $code
     * @return int
     */
    public function deleteByCode(int $id, string $code)
    {
        try {
            $result = Role::query()
                ->where('id', $id)
                ->where('public', NYEnumConstants::YES)
                ->where('code', $code)
                ->delete();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = 0;
        }

        return $result;
    }

    /**
     * @param string $code
     * @return Role
     */
    public function firstByCode(string $code)
    {
        $result = null;
        try {
            $result = Role::where('code', $code)
                ->where('public', NYEnumConstants::YES)
                ->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function get()
    {
        $result = collect();
        try {
            $result = Role::where('public', NYEnumConstants::YES)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     * @return Role[]|Collection
     */
    public function getByIds(array $ids)
    {
        $result = collect();
        try {
            $result = Role::where('public', NYEnumConstants::YES)
                ->whereIn('id', $ids)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
