<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/4
 * Time: 上午 10:20
 */

use Modules\Literature\Policies\GenresSettingPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'literature/genres/setting',
    'namespace'  => 'Modules\Literature\Http\Controllers'
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
