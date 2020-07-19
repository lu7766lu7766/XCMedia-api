<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/11
 * Time: 下午 04:34
 */

use Modules\Storytelling\Policies\ManageStorytellingPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'manage/storytelling',
    'namespace'  => 'Modules\Storytelling\Http\Controllers'
], function () {
    Route::get('/', 'ManageStorytellingController@index')
        ->middleware('can:read,' . ManageStorytellingPolicy::class);
    Route::get('/total', 'ManageStorytellingController@total')
        ->middleware('can:read,' . ManageStorytellingPolicy::class);
    Route::post('/', 'ManageStorytellingController@store')
        ->middleware('can:create,' . ManageStorytellingPolicy::class);
    Route::get('/info', 'ManageStorytellingController@info')
        ->middleware('can:update,' . ManageStorytellingPolicy::class);
    Route::post('/update', 'ManageStorytellingController@update')
        ->middleware('can:update,' . ManageStorytellingPolicy::class);
    Route::delete('/', 'ManageStorytellingController@delete')
        ->middleware('can:delete,' . ManageStorytellingPolicy::class);
    Route::get('/genres', 'ManageStorytellingController@genres')
        ->middleware('can:read,' . ManageStorytellingPolicy::class);
    Route::get('/region', 'ManageStorytellingController@region')
        ->middleware('can:read,' . ManageStorytellingPolicy::class);
    Route::get('/years', 'ManageStorytellingController@years')
        ->middleware('can:read,' . ManageStorytellingPolicy::class);
    Route::get('/status', 'ManageStorytellingController@status')
        ->middleware('can:read,' . ManageStorytellingPolicy::class);
    Route::group(['middleware' => 'can:editFile,' . ManageStorytellingPolicy::class], function () {
        Route::post('image/upload', 'ManageStorytellingController@uploadImage');
        Route::post('image/remove', 'ManageStorytellingController@removeImage');
    });
});
