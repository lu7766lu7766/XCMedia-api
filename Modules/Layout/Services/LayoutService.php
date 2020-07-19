<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/25
 * Time: 下午 02:30
 */

namespace Modules\Layout\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Layout\Entities\Layout;
use Modules\Layout\Repositories\LayoutRepo;
use XC\Independent\Kit\Utils\UrlParserUtil;

class LayoutService
{
    /** @var UrlParserUtil $url */
    private $url;
    /** @var LayoutRepo $repo */
    private $repo;

    /**
     * LayoutService constructor.
     * @param UrlParserUtil $url
     * @param LayoutRepo $repo
     */
    public function __construct(UrlParserUtil $url, LayoutRepo $repo)
    {
        $this->url = $url;
        $this->repo = $repo;
    }

    /**
     * @return Collection|Layout[]
     */
    public function list()
    {
        return $this->repo->getEnableByDomain($this->url->host());
    }
}
