<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/16
 * Time: 下午 02:41
 */
Route::group([
    'middleware' => [
        'debug_cnf',
        'throttle:200,1',
        'cros',
        'json_response',
    ],
    'prefix'     => 'client/anime/',
    'namespace'  => 'Modules\Anime\Http\Controllers'
], function () {
    Route::get('/latest', 'AnimeEntranceController@latestList');
    Route::get('/popular', 'AnimeEntranceController@popularList');
    Route::get('/most_comment', 'AnimeEntranceController@mostComment')->middleware('referrer');
    Route::get('/info', 'AnimeEntranceController@info');
    Route::get('/episode', 'AnimeEntranceController@source');
    Route::get('/comment', 'AnimeEntranceController@commentList')->middleware('referrer');
    Route::get('/comment/total', 'AnimeEntranceController@commentTotal')->middleware('referrer');
    Route::get('/total', 'AnimeEntranceController@total');
    Route::get('/region', 'AnimeEntranceController@region');
    Route::get('/years', 'AnimeEntranceController@years');
    Route::get('/genres', 'AnimeEntranceController@genres');
    Route::get('/status', 'AnimeEntranceController@status');
    Route::get('/language', 'AnimeEntranceController@language');
    Route::get('/is_favorite', 'AnimeEntranceController@isFavorite')->middleware('client_api');
});
