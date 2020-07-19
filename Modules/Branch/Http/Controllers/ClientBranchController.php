<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/27
 * Time: 下午 05:04
 */

namespace Modules\Branch\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Branch\Services\ClientBranchService;
use XC\Independent\Kit\Utils\UrlParserUtil;

class ClientBranchController extends Controller
{
    /**
     * @param UrlParserUtil $url
     * @return \Modules\Branch\Entities\Branch|null
     */
    public function info(UrlParserUtil $url)
    {
        $service = new ClientBranchService();

        return $service->info($url);
    }
}
