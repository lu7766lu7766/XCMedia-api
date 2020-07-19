<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/17
 * Time: 下午 02:59
 */

namespace Modules\Classified\Constants;

use Modules\Anime\Entities\Anime;
use Modules\Drama\Entities\Drama;
use Modules\Movie\Entities\Movie;
use Modules\Variety\Entities\Variety;
use XC\Independent\Kit\Constants\BaseConstants;

class ClassifiedMorphMapConstants extends BaseConstants
{
    //影音電影
    const MOVIE = Movie::class;
    //影音戲劇
    const DRAMA = Drama::class;
    //影音動漫
    const ANIME = Anime::class;
    //影音綜藝
    const VARIETY = Variety::class;

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::MOVIE,
            self::DRAMA,
            self::ANIME,
            self::VARIETY,
        ];
    }

    /**
     * @param string $type
     * @return string
     */
    public static function map(string $type)
    {
        $list = [
            'movie'   => self::MOVIE,
            'drama'   => self::DRAMA,
            'anime'   => self::ANIME,
            'variety' => self::VARIETY,
        ];

        return $list[$type];
    }
}
