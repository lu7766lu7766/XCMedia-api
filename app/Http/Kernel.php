<?php

namespace App\Http;

use App\Http\Middleware\CodeDataJsonResponse;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\VerifyCsrfToken;
use Barryvdh\Cors\HandleCors;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Modules\Base\Http\Middleware\DebugConfigure;
use Modules\Base\Http\Middleware\ValidateRequiredReferer;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        TrustProxies::class
    ];
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            'debug_cnf',
            EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            'debug_cnf',
            'throttle:300,1', // 單一user每N分鐘X次request的意思(任意入口統合計算)
            'cros',
            'auth:api', // 認證使用config/auth.php => guards.api,
            'json_response',
        ],
        'client_api'=>[
            'debug_cnf',
            'throttle:300,1', // 單一user每N分鐘X次request的意思(任意入口統合計算)
            'cros',
            'auth:client_api', // 認證使用config/auth.php => guards.api,
            'json_response',
        ],
    ];
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'          => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'    => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'      => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'           => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'         => RedirectIfAuthenticated::class,
        'signed'        => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'      => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'cros'          => HandleCors::class,
        'json_response' => CodeDataJsonResponse::class,
        'debug_cnf'     => DebugConfigure::class,
        'referrer'      => ValidateRequiredReferer::class,
    ];
}
