<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/04
 * Time: 下午 03:49
 */

use Modules\Literature\Policies\ManageLiteraturePolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'literature/manage/',
    'namespace'  => 'Modules\Literature\Http\Controllers'
], function () {
    Route::group([
        'middleware' => 'can:read,' . ManageLiteraturePolicy::class
    ], function () {
        Route::get('/options/get_region', 'ManageLiteratureController@getRegion');
        Route::get('/options/get_year', 'ManageLiteratureController@getYears');
        Route::get('/options/get_genres', 'ManageLiteratureController@getGenres');
    });
    Route::group([
        'middleware' => 'can:upload,' . ManageLiteraturePolicy::class
    ], function () {
        Route::post('/image', 'ManageLiteratureController@uploadImage');
        Route::delete('/image', 'ManageLiteratureController@removeImage');
    });
    Route::get('/', 'ManageLiteratureController@list')
        ->middleware('can:read,' . ManageLiteraturePolicy::class);
    Route::post('/', 'ManageLiteratureController@add')
        ->middleware('can:add,' . ManageLiteraturePolicy::class);
    Route::post('/update', 'ManageLiteratureController@edit')
        ->middleware('can:edit,' . ManageLiteraturePolicy::class);
    Route::delete('/', 'ManageLiteratureController@delete')
        ->middleware('can:delete,' . ManageLiteraturePolicy::class);
    Route::get('/count', 'ManageLiteratureController@count')
        ->middleware('can:read,' . ManageLiteraturePolicy::class);
});
