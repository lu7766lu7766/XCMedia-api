<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/19
 * Time: 下午 03:57
 */
Route::group(
    [
        'middleware' => [
            'debug_cnf',
            'throttle:200,1',
            'cros',
            'json_response',
            'referrer'
        ],
        'prefix'     => 'faq/client',
        'namespace'  => 'Modules\FAQ\Http\Controllers'
    ],
    function () {
        Route::get('/', 'ClientFAQController@index');
        Route::get('/total', 'ClientFAQController@total');
    }
);
