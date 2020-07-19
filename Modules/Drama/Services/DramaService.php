<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/6
 * Time: 下午 08:22
 */

namespace Modules\Drama\Services;

use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Constants\ClassifiedMorphMapConstants;
use Modules\Classified\Repositories\SourceSettingRepo;
use Modules\Drama\Entities\Drama;
use Modules\Drama\Http\Requests\ClientListRequestHandle;
use Modules\Drama\Http\Requests\GetCommentRequestHandle;
use Modules\Drama\Http\Requests\GetIdRequestHandle;
use Modules\Drama\Repositories\DramaRepo;
use Modules\Member\Repositories\MemberCommentRepo;
use XC\Independent\Kit\Utils\UrlParserUtil;

class DramaService
{
    /** @var DramaRepo $repo */
    private $repo;
    /** @var SourceSettingRepo $sourceRepo */
    private $sourceRepo;
    /** @var UrlParserUtil $url */
    private $url;

    /**
     * DramaService constructor.
     * @param UrlParserUtil $url
     */
    public function __construct(UrlParserUtil $url)
    {
        $this->repo = new DramaRepo();
        $this->sourceRepo = new SourceSettingRepo(ClassifiedConstant::DRAMA);
        $this->url = $url;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Drama\Entities\Drama[]
     */
    public function getLatest()
    {
        return $this->repo->limitTen();
    }

    /**
     * @param ClientListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Drama\Entities\Drama[]
     */
    public function list(ClientListRequestHandle $request)
    {
        return $this->repo->getClientList(
            $this->url->host(),
            $request->getSort(),
            $request->getEpisodeStatus(),
            $request->getLanguageId(),
            $request->getYearsId(),
            $request->getRegionId(),
            $request->getGenresId(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param ClientListRequestHandle $request
     * @return int
     */
    public function count(ClientListRequestHandle $request)
    {
        return $this->repo->getClientListCount(
            $request->getEpisodeStatus(),
            $request->getLanguageId(),
            $request->getYearsId(),
            $request->getRegionId(),
            $request->getGenresId()
        );
    }

    /**
     * @param GetIdRequestHandle $request
     * @return Drama|null
     */
    public function detail(GetIdRequestHandle $request)
    {
        $result = $this->repo->findClientEnable($request->getId());
        if (!is_null($result)) {
            $result->increment('views');
        }

        return $result;
    }

    /**
     * @param GetIdRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Source[]
     */
    public function sources(GetIdRequestHandle $request)
    {
        return $this->sourceRepo->getAllByUsedTypeWithEpisode($request->getId());
    }

    /**
     * @param GetCommentRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Member\Entities\MemberComment[]
     */
    public function commentList(GetCommentRequestHandle $request)
    {
        $comment = new MemberCommentRepo();

        return $comment->list(
            $request->getMediaId(),
            ClassifiedMorphMapConstants::DRAMA,
            $this->url->host(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param GetCommentRequestHandle $request
     * @return int
     */
    public function commentCount(GetCommentRequestHandle $request)
    {
        $comment = new MemberCommentRepo();

        return $comment->count(
            $request->getMediaId(),
            ClassifiedMorphMapConstants::DRAMA,
            $this->url->host()
        );
    }
}
