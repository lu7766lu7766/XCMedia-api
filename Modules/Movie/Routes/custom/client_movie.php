<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/3/16
 * Time: 下午 03:11
 */
Route::group(
    [
        'middleware' => [
            'debug_cnf',
            'throttle:200,1',
            'cros',
            'json_response'
        ],
        'prefix'     => 'movie/client',
        'namespace'  => 'Modules\Movie\Http\Controllers'
    ],
    function () {
        Route::get('latest/list', 'MovieController@latest');
        Route::get('popular/list', 'MovieController@popular');
        Route::get('hot_topic/list', 'MovieController@hotTopic')->middleware('referrer');
        Route::get('total', 'MovieController@total');
        Route::get('comment/list', 'MovieController@comments')->middleware('referrer');
        Route::get('comment/total', 'MovieController@commentsTotal')->middleware('referrer');
        Route::get('info', 'MovieController@info');
        Route::get('source', 'MovieController@source');
        Route::get('is_favorite', 'MovieController@isFavorite')->middleware('client_api');
        Route::get('options', 'MovieController@options');
    }
);
