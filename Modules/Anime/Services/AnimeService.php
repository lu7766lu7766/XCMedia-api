<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/6
 * Time: 下午 08:15
 */

namespace Modules\Anime\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Anime\Entities\Anime;
use Modules\Anime\Repositories\AnimeRepo;

class AnimeService
{
    /** @var AnimeRepo $repo */
    private $repo;

    /**
     * AnimeService constructor.
     * @param AnimeRepo $repo
     */
    public function __construct(AnimeRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return Collection|Anime[]
     */
    public function getLatest()
    {
        return $this->repo->limitTen();
    }
}
