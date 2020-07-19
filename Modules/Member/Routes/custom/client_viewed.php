<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/5
 * Time: 下午 04:54
 */
Route::group([
    'middleware' => 'client_api',
    'prefix'     => 'client/viewed/episode',
    'namespace'  => 'Modules\Member\Http\Controllers'
], function () {
    Route::get('/', 'MemberViewedController@episodeIndex');
    Route::post('/', 'MemberViewedController@episodeStore');
    Route::get('/total', 'MemberViewedController@episodeTotal');
    Route::get('/type', 'MemberViewedController@episodeTypes');
    Route::delete('/', 'MemberViewedController@episodeClear');
});
