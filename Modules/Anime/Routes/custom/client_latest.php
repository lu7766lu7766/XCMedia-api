<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/6
 * Time: 下午 08:11
 */
Route::group([
    'middleware' => [
        'debug_cnf',
        'throttle:200,1',
        'cros',
        'json_response',
        'referrer'
    ],
    'prefix'     => 'anime/latest',
    'namespace'  => 'Modules\Anime\Http\Controllers'
], function () {
    Route::get('/', 'AnimeController@index');
});
