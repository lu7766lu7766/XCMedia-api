<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/20
 * Time: 下午 04:01
 */

namespace Modules\Role\Constants;

use XC\Independent\Kit\Constants\BaseConstants;

class RoleInherentConstants extends BaseConstants
{
    const ADMIN = 'ADMIN';
    // 系統管理員
    const SYSTEM_MANAGER = 'SYSTEM_MG';
    // 自訂
    const CUSTOM = 'CUSTOM';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::ADMIN,
            self::SYSTEM_MANAGER,
            self::CUSTOM,
        ];
    }
}
