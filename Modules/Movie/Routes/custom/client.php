<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 05:02
 */
Route::group([
    'middleware' => 'client_api',
    'prefix'     => 'movie/favorite',
    'namespace'  => 'Modules\Movie\Http\Controllers'
], function () {
    Route::post('/add', 'MovieController@add');
    Route::post('/remove', 'MovieController@remove');
});
Route::group([
    'middleware' => ['debug_cnf', 'throttle:300,1', 'cros', 'json_response'],
    'prefix'     => 'client/movie',
    'namespace'  => 'Modules\Movie\Http\Controllers'
], function () {
    Route::get('/topTen', 'LeaderBoardController@index');
});
