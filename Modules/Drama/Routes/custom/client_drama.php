<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/16
 * Time: 上午 11:45
 */
Route::group([
    'middleware' => [
        'debug_cnf',
        'throttle:200,1',
        'cros',
        'json_response',
        'referrer'
    ],
    'prefix'     => 'drama',
    'namespace'  => 'Modules\Drama\Http\Controllers'
], function () {
    Route::get('/', 'DramaController@list');
    Route::get('/total', 'DramaController@total');
    Route::get('/detail', 'DramaController@detail');
    Route::get('/options', 'DramaController@options');
    Route::get('/comment', 'DramaController@commentList');
    Route::get('/comment/total', 'DramaController@commentTotal');
    Route::get('/sources', 'DramaController@sourcesList');
});
