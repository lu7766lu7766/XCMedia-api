<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/19
 * Time: 下午 04:40
 */

namespace Modules\FAQ\Services;

use Modules\Base\Exception\ApiErrorCodeException;
use Modules\FAQ\Entities\FAQ;
use Modules\FAQ\Http\Requests\ClientListRequestHandle;
use Modules\FAQ\Repositories\FAQRepo;
use XC\Independent\Kit\Utils\UrlParserUtil;

class ClientFAQService
{
    /** @var FAQRepo $repo */
    private $repo;
    /** @var UrlParserUtil $urlParser */
    private $urlParser;

    /**
     * ClientFAQService constructor.
     * @param UrlParserUtil $urlParser
     */
    public function __construct(UrlParserUtil $urlParser)
    {
        $this->urlParser = $urlParser;
        $this->repo = new FAQRepo();
    }

    /**
     * @param ClientListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|FAQ[]
     * @throws ApiErrorCodeException
     */
    public function get(ClientListRequestHandle $request)
    {
        return $this->repo->getListMorphBranch($this->urlParser->host(), $request->getPage(), $request->getPerpage());
    }

    /**
     * @return int
     */
    public function total()
    {
        return $this->repo->countMorphBranch($this->urlParser->host());
    }
}
