<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;

/**
 * 1. Http response status code always is 200
 * 2. Response body is json
 * 3. Key code of json 表示執行結果是否異常,0表示正常運作,其他則是錯誤,錯誤時請參照文件查詢code的意義
 * 4. Key data of json 放置執行結果資料(非正常運錯時會放置debug msg)
 * Class CodeDataJsonResponse
 * @package App\Http\Middleware
 */
class CodeDataJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');
        $response = $next($request);
        $content = [];
        if (config('app.debug')) {
            $content['client_request_body'] = $request->request->all();
            $content['query_loq'] = \DB::getQueryLog();
        }
        if ($response instanceof JsonResponse) {
            // exception occur.
            if (method_exists($response, 'withException') && !is_null($response->exception)) {
                $tmpContent = $this->formatExceptionToJson($response->exception);
                $content['code'] = $tmpContent['code'];
                $content['data'] = [];
                if (config('app.debug')) {
                    $content['data'] = $tmpContent['data'];
                } else {
                    $content['data']['msg'] = $tmpContent['data']['msg'];
                }
            } else {
                $tmpContent = $response->getData(true);
                $content['code'] = OOOO1CommonCodes::OK;
                $content['data'] = $tmpContent['data'] ?? $tmpContent;
            }
            $response->setData($content);
        } elseif (($response instanceof Response)) {
            if (!is_null($tmpContent = $response->getContent()) || $tmpContent !== '') {
                $tmpContent = json_decode($tmpContent, true);
            }
            if (is_scalar($tmpContent) || is_null($tmpContent)) {
                $content['data'] = $response->getContent();
            } else {
                $content['data'] = $tmpContent['data'] ?? $tmpContent;
            }
            $content['code'] = OOOO1CommonCodes::OK;
            $response->setContent($content);
        }

        return $response->setStatusCode(200);
    }

    /**
     * @param \Throwable $e
     * @return array
     */
    private function formatExceptionToJson(\Throwable $e)
    {
        if ($e instanceof ValidationException) {
            $msg = $e->validator->getMessageBag()->all();
            $trace = [];
            $code = [OOOO1CommonCodes::REQUEST_VALIDATE_FAIL];
        } else {
            $code = [OOOO1CommonCodes::ERROR];
            $msg = $e->getMessage();
            $trace = $e->getTrace();
            if ($e instanceof ApiErrorCodeException) {
                $code = $e->getCodes();
            } else {
                if ($e instanceof AuthorizationException) {
                    $code = [OOOO1CommonCodes::ACCESS_DENIED];
                } elseif ($e instanceof OAuthServerException) {
                    $code = [OOOO1CommonCodes::AUTHENTICATION_FAIL];
                }
            }
        }
        $result = [
            'code' => $code,
            'data' => [
                'line'  => $e->getLine(),
                'msg'   => $msg,
                'trace' => $trace
            ]
        ];

        return $result;
    }
}
