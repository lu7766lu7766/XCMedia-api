<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 02:12
 */

namespace Modules\Classified\Constants;

use XC\Independent\Kit\Constants\BaseConstants;

class AVActressUsedTypeConstants extends BaseConstants
{
    //成人長片
    const FEATURE_FILM = 'feature_film';
    //成人短片
    const SHORT_FILM = 'short_film';
    //自拍
    const SELFIE = 'selfie';
    //成人寫真
    const PHOTOGRAPH = 'photograph';
    //成人視頻
    const VIDEO = 'video';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::FEATURE_FILM,
            self::SHORT_FILM,
            self::SELFIE,
            self::PHOTOGRAPH,
            self::VIDEO,
        ];
    }
}
