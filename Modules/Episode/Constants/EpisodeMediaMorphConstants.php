<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/5
 * Time: 下午 07:38
 */

namespace Modules\Episode\Constants;

use Modules\Anime\Entities\Anime;
use Modules\Comic\Entities\Comic;
use Modules\Drama\Entities\Drama;
use Modules\Movie\Entities\Movie;
use Modules\Storytelling\Entities\Storytelling;
use Modules\Variety\Entities\Variety;
use XC\Independent\Kit\Constants\BaseConstants;

class EpisodeMediaMorphConstants extends BaseConstants
{
    //影音電影
    const MOVIE = 'movie';
    //影音戲劇
    const DRAMA = 'drama';
    //影音動漫
    const ANIME = 'anime';
    //影音綜藝
    const VARIETY = 'variety';
    //漫畫
    const COMIC = 'comic';
    //成人說書
    const STORYTELLING = 'storytelling';

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
            self::COMIC,
            self::STORYTELLING
        ];
    }

    /**
     * @return array
     */
    public static function morphMap(): array
    {
        return [
            self::MOVIE        => Movie::class,
            self::DRAMA        => Drama::class,
            self::ANIME        => Anime::class,
            self::VARIETY      => Variety::class,
            self::COMIC        => Comic::class,
            self::STORYTELLING => Storytelling::class,
        ];
    }

    /**
     * @param null|string $type
     * @return string|null
     */
    public static function mapping(?string $type)
    {
        $result = null;
        if (!is_null($type) && self::isValidValue($type)) {
            $result = self::morphMap()[$type];
        }

        return $result;
    }
}
