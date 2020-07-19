<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 02:58
 */

namespace Modules\FeatureFilm\Constants;

use XC\Independent\Kit\Constants\BaseConstants;

/**
 * 馬賽克類型
 * @package Modules\FeatureFilm
 */
class MosaicConstants extends BaseConstants
{
    /** @var string 有碼 */
    const WITH_MOSAIC = 'WITH_MOSAIC';
    /** @var string 無碼 */
    const NO_MOSAIC = 'NO_MOSAIC';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::WITH_MOSAIC,
            self::NO_MOSAIC
        ];
    }
}
