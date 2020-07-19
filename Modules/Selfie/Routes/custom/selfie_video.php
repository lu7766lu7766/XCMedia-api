<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 下午 03:45
 */

use Modules\Selfie\Policies\SelfieVideoPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'manage/selfie/video',
    'namespace'  => 'Modules\Selfie\Http\Controllers'
], function () {
    Route::get('/', 'ManageSelfieVideoController@index')->middleware('can:read,' . SelfieVideoPolicy::class);
    Route::get('/total', 'ManageSelfieVideoController@total')->middleware('can:read,' . SelfieVideoPolicy::class);
    Route::post('/', 'ManageSelfieVideoController@store')->middleware('can:create,' . SelfieVideoPolicy::class);
    Route::get('/info', 'ManageSelfieVideoController@info')->middleware('can:update,' . SelfieVideoPolicy::class);
    Route::post('/update', 'ManageSelfieVideoController@update')->middleware('can:update,' . SelfieVideoPolicy::class);
    Route::delete('/', 'ManageSelfieVideoController@delete')->middleware('can:delete,' . SelfieVideoPolicy::class);
});
