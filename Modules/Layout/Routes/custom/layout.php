<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/25
 * Time: 下午 02:40
 */
Route::group(
    [
        'middleware' => [
            'debug_cnf',
            'throttle:300,1', // 單一user每N分鐘X次request的意思(任意入口統合計算)
            'cros',
            'json_response',
            'referrer'
        ],
        'prefix'     => 'client/layout',
        'namespace'  => 'Modules\Layout\Http\Controllers'
    ],
    function () {
        Route::get('/', 'LayoutController@index');
    }
);
