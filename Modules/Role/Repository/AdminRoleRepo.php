<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/6/26
 * Time: 下午 03:31
 */

namespace Modules\Role\Repository;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Role\Contract\IRoleProvider;
use Modules\Role\Entities\Role;

class AdminRoleRepo implements IRoleProvider
{
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
     * @inheritdoc
     * @return Role[]|Collection
     */
    public function get()
    {
        $result = collect();
        try {
            $result = Role::all();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     * @return Role
     */
    public function firstByCode(string $code)
    {
        $result = null;
        try {
            $result = Role::where('code', $code)->first();
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
            $result = Role::whereIn('id', $ids)->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
