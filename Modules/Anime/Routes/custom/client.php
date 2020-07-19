<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 05:12
 */
Route::group([
    'middleware' => ['debug_cnf', 'throttle:300,1', 'cros', 'json_response'],
    'prefix'     => 'client/anime',
    'namespace'  => 'Modules\Anime\Http\Controllers'
], function () {
    Route::get('/topTen', 'LeaderBoardController@index');
});
Route::group([
    'middleware' => 'client_api',
    'prefix'     => 'anime/favorite',
    'namespace'  => 'Modules\Anime\Http\Controllers'
], function () {
    Route::post('/add', 'AnimeController@add');
    Route::post('/remove', 'AnimeController@remove');
});
