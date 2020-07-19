<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/27
 * Time: 下午 05:08
 */

namespace Modules\Branch\Services;

use Modules\Branch\Repositories\BranchRepo;
use XC\Independent\Kit\Utils\UrlParserUtil;

class ClientBranchService
{
    /**
     * @param UrlParserUtil $url
     * @return \Modules\Branch\Entities\Branch|null
     */
    public function info(UrlParserUtil $url)
    {
        $repo = new BranchRepo();

        return $repo->firstByDomain($url->host());
    }
}
