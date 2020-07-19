<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/14
 * Time: 下午 02:51
 */

namespace Modules\Episode\Constants;

use XC\Independent\Kit\Constants\BaseConstants;

class EpisodeStatusConstants extends BaseConstants
{
    //連載中
    const SERIALIZING = 'serializing';
    //完結
    const END = 'end';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::SERIALIZING,
            self::END,
        ];
    }
}
