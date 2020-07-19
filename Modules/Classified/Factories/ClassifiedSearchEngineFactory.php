<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 06:08
 */

namespace Modules\Classified\Factories;

use Modules\Anime\Repositories\AnimeRepo;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Contracts\ISearchEngine;
use Modules\Drama\Repositories\DramaRepo;
use Modules\Movie\Repositories\MovieRepo;
use Modules\Variety\Repositories\VarietyRepo;
use XC\Independent\Kit\Support\Traits\Pattern\Factory;

/**
 * Class ClassifiedSearchEngineFactory
 * @package Modules\Classified\Factories
 * @method static ISearchEngine|null make(string $key)
 */
class ClassifiedSearchEngineFactory
{
    use Factory;

    /**
     * @return array
     */
    public static function map(): array
    {
        return [
            ClassifiedConstant::DRAMA   => DramaRepo::class,
            ClassifiedConstant::MOVIE   => MovieRepo::class,
            ClassifiedConstant::ANIME   => AnimeRepo::class,
            ClassifiedConstant::VARIETY => VarietyRepo::class
        ];
    }
}
