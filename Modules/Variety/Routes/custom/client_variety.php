<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/16
 * Time: 下午 03:41
 */
Route::group([
    'middleware' => [
        'debug_cnf',
        'throttle:200,1',
        'cros',
        'json_response'
    ],
    'prefix'     => 'variety',
    'namespace'  => 'Modules\Variety\Http\Controllers'
], function () {
    Route::get('/list/latest', 'VarietyController@latestList');
    Route::get('/list/popular', 'VarietyController@popularList');
    Route::get('/list/most_comment', 'VarietyController@mostCommentList')->middleware('referrer');
    Route::get('/total', 'VarietyController@total');
    Route::get('/info', 'VarietyController@info');
    Route::get('/comments/list', 'VarietyController@commentsList')->middleware('referrer');
    Route::get('/comments/total', 'VarietyController@commentsTotal')->middleware('referrer');
    Route::get('/source', 'VarietyController@source');
    Route::get('/options', 'VarietyController@options');
    Route::get('/is_favorite', 'VarietyController@isFavorite')->middleware('client_api');
});
