<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 下午 03:28
 */

use Modules\Selfie\Policies\SelfieSchedulePolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'manage/selfie/schedule',
    'namespace'  => 'Modules\Selfie\Http\Controllers'
], function () {
    Route::get('/', 'ManageSelfieScheduleController@index')
        ->middleware('can:read,' . SelfieSchedulePolicy::class);
    Route::get('/total', 'ManageSelfieScheduleController@total')
        ->middleware('can:read,' . SelfieSchedulePolicy::class);
    Route::post('/', 'ManageSelfieScheduleController@store')
        ->middleware('can:create,' . SelfieSchedulePolicy::class);
    Route::get('/info', 'ManageSelfieScheduleController@info')
        ->middleware('can:update,' . SelfieSchedulePolicy::class);
    Route::post('/update', 'ManageSelfieScheduleController@update')
        ->middleware('can:update,' . SelfieSchedulePolicy::class);
    Route::delete('/', 'ManageSelfieScheduleController@delete')
        ->middleware('can:delete,' . SelfieSchedulePolicy::class);
    Route::get('/genres', 'ManageSelfieScheduleController@genres')
        ->middleware('can:read,' . SelfieSchedulePolicy::class);
    Route::get('/region', 'ManageSelfieScheduleController@region')
        ->middleware('can:read,' . SelfieSchedulePolicy::class);
    Route::get('/actress', 'ManageSelfieScheduleController@actress')
        ->middleware('can:read,' . SelfieSchedulePolicy::class);
    Route::get('/cup', 'ManageSelfieScheduleController@cup')
        ->middleware('can:read,' . SelfieSchedulePolicy::class);
    Route::get('/years', 'ManageSelfieScheduleController@years')
        ->middleware('can:read,' . SelfieSchedulePolicy::class);
    Route::get('/status', 'ManageSelfieScheduleController@status')
        ->middleware('can:read,' . SelfieSchedulePolicy::class);
});
