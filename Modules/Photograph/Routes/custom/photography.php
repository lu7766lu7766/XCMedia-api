<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 01:36
 */

use Modules\Photograph\Policies\PhotographyManagePolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'manage/photograph',
    'namespace'  => 'Modules\Photograph\Http\Controllers'
], function () {
    Route::get('/', 'PhotographyManageController@index')->middleware('can:read,' . PhotographyManagePolicy::class);
    Route::get('/total', 'PhotographyManageController@total')->middleware('can:read,' . PhotographyManagePolicy::class);
    Route::get('/info', 'PhotographyManageController@info')->middleware('can:update,' . PhotographyManagePolicy::class);
    Route::post('/', 'PhotographyManageController@store')->middleware('can:create,' . PhotographyManagePolicy::class);
    Route::post('/update', 'PhotographyManageController@update')
        ->middleware('can:update,' . PhotographyManagePolicy::class);
    Route::delete('/', 'PhotographyManageController@delete')
        ->middleware('can:delete,' . PhotographyManagePolicy::class);
    Route::get('/region', 'PhotographyManageController@region')
        ->middleware('can:read,' . PhotographyManagePolicy::class);
    Route::get('/actress', 'PhotographyManageController@actress')
        ->middleware('can:read,' . PhotographyManagePolicy::class);
    Route::get('/cup', 'PhotographyManageController@cup')
        ->middleware('can:read,' . PhotographyManagePolicy::class);
    Route::get('/genres', 'PhotographyManageController@genres')
        ->middleware('can:read,' . PhotographyManagePolicy::class);
    Route::get('/years', 'PhotographyManageController@years')
        ->middleware('can:read,' . PhotographyManagePolicy::class);
});
