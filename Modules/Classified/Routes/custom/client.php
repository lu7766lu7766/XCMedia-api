<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 05:56
 */
Route::group([
    'middleware' => [
        'debug_cnf',
        'throttle:300,1',
        'cros',
        'json_response',
    ],
    'prefix'     => 'client/classified',
    'namespace'  => 'Modules\Classified\Http\Controllers'
], function () {
    Route::get('/search', 'ClassifiedController@search');
    Route::get('/search/total', 'ClassifiedController@searchCount');
    Route::get('/search/type', 'ClassifiedController@type');
});
