<?php

namespace Modules\Base\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * 當env 設定DEBUG=true時,啟用DB query log
 * Class DebugConfigure
 * @package Modules\Base\Http\Middleware
 */
class DebugConfigure
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('app.debug')) {
            \DB::enableQueryLog();
        }

        return $next($request);
    }
}
