<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/4
 * Time: 上午 10:15
 */

namespace Modules\Account\Constants;

use XC\Independent\Kit\Constants\BaseConstants;

class AccountStatusConstants extends BaseConstants
{
    //啟用中
    const ENABLE = 'enable';
    //停用
    const DISABLE = 'disable';
    //凍結
    const FREEZE = 'freeze';
    //清查
    const CHECK = 'check';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::ENABLE,
            self::DISABLE,
            self::FREEZE,
            self::CHECK
        ];
    }

    /**
     * @return array
     */
    public static function common()
    {
        return [
            AccountStatusConstants::ENABLE,
            AccountStatusConstants::DISABLE
        ];
    }
}
