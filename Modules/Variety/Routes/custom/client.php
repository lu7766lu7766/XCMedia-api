<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 05:26
 */
Route::group([
    'middleware' => 'client_api',
    'prefix'     => 'variety/favorite',
    'namespace'  => 'Modules\Variety\Http\Controllers'
], function () {
    Route::post('/add', 'VarietyController@add');
    Route::post('/remove', 'VarietyController@remove');
});
Route::group([
    'middleware' => ['debug_cnf', 'throttle:300,1', 'cros', 'json_response'],
    'prefix'     => 'client/variety',
    'namespace'  => 'Modules\Variety\Http\Controllers'
], function () {
    Route::get('/topTen', 'LeaderBoardController@index');
});
