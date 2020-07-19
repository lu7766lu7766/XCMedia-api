<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/6
 * Time: 下午 03:07
 */

namespace Modules\Member\Constants;

use Modules\Episode\Entities\Episode;
use XC\Independent\Kit\Constants\BaseConstants;

class MemberViewedMorphConstants extends BaseConstants
{
    const EPISODE = 'episode';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::EPISODE
        ];
    }

    /**
     * @return array
     */
    public static function morphMap(): array
    {
        return [
            self::EPISODE => Episode::class,
        ];
    }
}
