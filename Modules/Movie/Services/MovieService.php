<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/6
 * Time: 下午 08:27
 */

namespace Modules\Movie\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Repositories\SourceSettingRepo;
use Modules\Movie\Entities\Movie;
use Modules\Movie\Http\Requests\Client\MovieCommentsListRequest;
use Modules\Movie\Http\Requests\Client\MovieIndexRequest;
use Modules\Movie\Http\Requests\Client\MovieInfoRequest;
use Modules\Movie\Repositories\ClientMovieRepo;
use Modules\Movie\Repositories\MovieRepo;
use XC\Independent\Kit\Utils\UrlParserUtil;

class MovieService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Movie\Entities\Movie[]
     */
    public function getLatest()
    {
        $repo = new MovieRepo();

        return $repo->limitTen();
    }

    /**
     * @param MovieIndexRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|Movie[]
     */
    public function latestList(MovieIndexRequest $request)
    {
        return app(ClientMovieRepo::class)->latestList(
            $request->getRegionId(),
            $request->getGenresId(),
            $request->getYearsId(),
            $request->getLanguageId(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param MovieIndexRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|Movie[]
     */
    public function popularList(MovieIndexRequest $request)
    {
        return app(ClientMovieRepo::class)->popularList(
            $request->getRegionId(),
            $request->getGenresId(),
            $request->getYearsId(),
            $request->getLanguageId(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param MovieIndexRequest $request
     * @param UrlParserUtil $url
     * @return \Illuminate\Database\Eloquent\Collection|Movie[]
     */
    public function hotTopicList(MovieIndexRequest $request, UrlParserUtil $url)
    {
        return app(ClientMovieRepo::class)->hotTopicList(
            $request->getRegionId(),
            $request->getGenresId(),
            $request->getYearsId(),
            $request->getLanguageId(),
            $url->host(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param MovieIndexRequest $request
     * @return int
     */
    public function total(MovieIndexRequest $request)
    {
        return app(ClientMovieRepo::class)->total(
            $request->getRegionId(),
            $request->getGenresId(),
            $request->getYearsId(),
            $request->getLanguageId()
        );
    }

    /**
     * @param int $id
     * @return Movie
     * @throws ApiErrorCodeException
     */
    public function info(int $id)
    {
        $result = app(ClientMovieRepo::class)->info($id);
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND);
        }
        $result->increment('views');

        return $result;
    }

    /**
     * @param MovieCommentsListRequest $request
     * @param UrlParserUtil $url
     * @return Movie|null
     */
    public function commentsList(MovieCommentsListRequest $request, UrlParserUtil $url)
    {
        return app(ClientMovieRepo::class)->commentsList(
            $request->getId(),
            $url->host(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param MovieCommentsListRequest $request
     * @param UrlParserUtil $url
     * @return int
     */
    public function commentsTotal(MovieCommentsListRequest $request, UrlParserUtil $url)
    {
        return app(ClientMovieRepo::class)->commentsTotal(
            $request->getId(),
            $url->host()
        );
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Modules\Classified\Entities\Source[]
     */
    public function source(int $id)
    {
        $repo = new SourceSettingRepo(ClassifiedConstant::MOVIE);

        return $repo->getAllByUsedTypeWithEpisode($id);
    }

    /**
     * @param MovieInfoRequest $request
     * @param Authenticatable $auth
     * @return bool
     */
    public function isFavorite(MovieInfoRequest $request, Authenticatable $auth)
    {
        return app(MovieRepo::class)->isFavoriteByMember(
            $request->getId(),
            $auth->getAuthIdentifier()
        );
    }
}
