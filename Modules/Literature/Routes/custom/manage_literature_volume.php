<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/04
 * Time: 下午 03:49
 */

use Modules\Literature\Policies\ManageLiteratureVolumePolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'literature/manage/volume',
    'namespace'  => 'Modules\Literature\Http\Controllers'
], function () {
    Route::group([
        'middleware' => 'can:upload,' . ManageLiteratureVolumePolicy::class
    ], function () {
        Route::post('/image', 'ManageLiteratureVolumeController@uploadImage');
        Route::delete('/image', 'ManageLiteratureVolumeController@removeImage');
    });
    Route::get('/', 'ManageLiteratureVolumeController@list')
        ->middleware('can:read,' . ManageLiteratureVolumePolicy::class);
    Route::get('/count', 'ManageLiteratureVolumeController@count')
        ->middleware('can:read,' . ManageLiteratureVolumePolicy::class);
    Route::post('/', 'ManageLiteratureVolumeController@add')
        ->middleware('can:add,' . ManageLiteratureVolumePolicy::class);
    Route::put('/', 'ManageLiteratureVolumeController@update')
        ->middleware('can:edit,' . ManageLiteratureVolumePolicy::class);
    Route::delete('/', 'ManageLiteratureVolumeController@delete')
        ->middleware('can:delete,' . ManageLiteratureVolumePolicy::class);
});
