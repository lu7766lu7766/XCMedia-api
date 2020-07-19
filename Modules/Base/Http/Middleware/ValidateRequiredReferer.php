<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/20
 * Time: 下午 12:23
 */

namespace Modules\Base\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use XC\Independent\Kit\Utils\UrlParserUtil;

/**
 * 藉由Referer確認,來自哪個訪問站
 * Class ValidateHeaderReferer
 * @package Modules\Base\Http\Middleware
 */
class ValidateRequiredReferer
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ApiErrorCodeException
     */
    public function handle(Request $request, Closure $next)
    {
        $key = 'Referer';
        if (!$request->hasHeader($key)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::HEADER_REFERER_IS_REQUIRED, 'HEADER REFER IS REQUIRED');
        }
        /** @var  UrlParserUtil $url */
        $url = app(UrlParserUtil::class);
        if (is_null($url->host())) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::HEADER_REFERER_URL_INVALID, 'HEADER REFER URL INVALID');
        }

        return $next($request);
    }
}
