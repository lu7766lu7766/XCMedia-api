<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/19
 * Time: 下午 03:38
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
        'prefix'     => 'client/advertisement',
        'namespace'  => 'Modules\Advertisement\Http\Controllers'
    ],
    function () {
        Route::get('/', 'AdvertisementController@index');
        Route::get('/info', 'AdvertisementController@info');
    }
);

