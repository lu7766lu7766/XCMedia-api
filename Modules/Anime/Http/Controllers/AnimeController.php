<?php

namespace Modules\Anime\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Modules\Anime\Entities\Anime;
use Modules\Anime\Repositories\AnimeRepo;
use Modules\Anime\Services\AnimeService;
use Modules\Member\Contracts\IFavoriteProvider;
use Modules\Member\Http\Controllers\MyFavoriteAction;

class AnimeController extends Controller
{
    /** @var AnimeService $service */
    private $service;
    use MyFavoriteAction;

    /**
     * AnimeController constructor.
     * @param AnimeService $service
     */
    public function __construct(AnimeService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Collection|Anime[]
     */
    public function index()
    {
        return $this->service->getLatest();
    }

    /**
     * @return IFavoriteProvider
     */
    public function getFavoriteRepo(): IFavoriteProvider
    {
        return new AnimeRepo();
    }
}
