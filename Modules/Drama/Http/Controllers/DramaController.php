<?php

namespace Modules\Drama\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Drama\Http\Requests\ClientListRequestHandle;
use Modules\Drama\Http\Requests\GetCommentRequestHandle;
use Modules\Drama\Http\Requests\GetIdRequestHandle;
use Modules\Drama\Repositories\DramaRepo;
use Modules\Drama\Services\DramaService;
use Modules\Episode\Constants\EpisodeStatusConstants;
use Modules\Member\Contracts\IFavoriteProvider;
use Modules\Member\Http\Controllers\MyFavoriteAction;

class DramaController extends Controller
{
    use MyFavoriteAction;
    /** @var DramaService $service */
    private $service;

    /**
     * DramaController constructor.
     */
    public function __construct()
    {
        $this->service = app(DramaService::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Drama\Entities\Drama[]
     */
    public function index()
    {
        return $this->service->getLatest();
    }

    /**
     * @param ClientListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Drama\Entities\Drama[]
     */
    public function list(ClientListRequestHandle $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param ClientListRequestHandle $request
     * @return int
     */
    public function total(ClientListRequestHandle $request)
    {
        return $this->service->count($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Modules\Drama\Entities\Drama|null
     */
    public function detail(GetIdRequestHandle $request)
    {
        return $this->service->detail($request);
    }

    /**
     * @param GetCommentRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Member\Entities\MemberComment[]
     */
    public function commentList(GetCommentRequestHandle $request)
    {
        return $this->service->commentList($request);
    }

    /**
     * @param GetCommentRequestHandle $request
     * @return int
     */
    public function commentTotal(GetCommentRequestHandle $request)
    {
        return $this->service->commentCount($request);
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Source[]
     */
    public function sourcesList(GetIdRequestHandle $request)
    {
        return $this->service->sources($request);
    }

    /**
     * @return array
     */
    public function options()
    {
        return [
            'language'       => app(LanguageSettingRepo::class)->getAllByUsedType(ClassifiedConstant::DRAMA),
            'genres'         => app(GenresSettingRepo::class)->getEnableUsedType(ClassifiedConstant::DRAMA),
            'region'         => app(RegionRepo::class)->getEnableByUsedType(ClassifiedConstant::DRAMA),
            'years'          => app(YearsSettingRepo::class)->getEnableByType(ClassifiedConstant::DRAMA),
            'episode_status' => EpisodeStatusConstants::enum()
        ];
    }

    /**
     * @return IFavoriteProvider
     */
    public function getFavoriteRepo(): IFavoriteProvider
    {
        return new DramaRepo();
    }
}
