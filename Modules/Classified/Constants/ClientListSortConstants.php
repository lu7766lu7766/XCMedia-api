<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/16
 * Time: 下午 02:18
 */

namespace Modules\Classified\Constants;

class ClientListSortConstants
{
    //人氣
    const HOT = 'hot';
    //評論
    const COMMENT = 'comment';
    //最新
    const NEW = 'new';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::HOT,
            self::COMMENT,
            self::NEW,
        ];
    }
}
