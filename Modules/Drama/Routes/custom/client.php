<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 03:59
 */
Route::group([
    'middleware' => ['debug_cnf', 'throttle:300,1', 'cros', 'json_response'],
    'prefix'     => 'client/drama',
    'namespace'  => 'Modules\Drama\Http\Controllers'
], function () {
    Route::get('/topTen', 'LeaderBoardController@index');
});
Route::group([
    'middleware' => 'client_api',
    'prefix'     => 'drama/favorite',
    'namespace'  => 'Modules\Drama\Http\Controllers'
], function () {
    Route::post('/add', 'DramaController@add');
    Route::post('/remove', 'DramaController@remove');
});
