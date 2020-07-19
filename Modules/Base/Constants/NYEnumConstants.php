<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/9
 * Time: 上午 11:48
 */

namespace Modules\Base\Constants;

use XC\Independent\Kit\Constants\BaseConstants;

class NYEnumConstants extends BaseConstants
{
    const YES = 'Y';
    const NO = 'N';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::YES,
            self::NO
        ];
    }
}
