<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/27
 * Time: 下午 05:06
 */
Route::group(
    [
        'middleware' => [
            'debug_cnf',
            'throttle:120,1',
            'cros',
            'json_response',
            'referrer'
        ],
        'prefix'     => 'branch/client/info',
        'namespace'  => 'Modules\Branch\Http\Controllers'
    ],
    function () {
        Route::get('/', 'ClientBranchController@info');
    }
);
