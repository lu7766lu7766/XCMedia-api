<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/1/31
 * Time: 上午 11:17
 */

use Modules\Drama\Policies\GenresSettingPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'drama/genres/setting',
    'namespace'  => 'Modules\Drama\Http\Controllers'
], function () {
    Route::get('/', 'GenresSettingController@index')
        ->middleware('can:read,' . GenresSettingPolicy::class);
    Route::get('/total', 'GenresSettingController@total')
        ->middleware('can:read,' . GenresSettingPolicy::class);
    Route::post('/', 'GenresSettingController@store')
        ->middleware('can:create,' . GenresSettingPolicy::class);
    Route::get('/edit', 'GenresSettingController@edit')
        ->middleware('can:update,' . GenresSettingPolicy::class);
    Route::post('/update', 'GenresSettingController@update')
        ->middleware('can:update,' . GenresSettingPolicy::class);
    Route::delete('/', 'GenresSettingController@delete')
        ->middleware('can:delete,' . GenresSettingPolicy::class);
});
