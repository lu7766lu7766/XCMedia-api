<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/6
 * Time: 下午 08:26
 */
Route::group([
    'middleware' => [
        'debug_cnf',
        'throttle:200,1',
        'cros',
        'json_response',
        'referrer'
    ],
    'prefix'     => 'movie/latest',
    'namespace'  => 'Modules\Movie\Http\Controllers'
], function () {
    Route::get('/', 'MovieController@index');
});
