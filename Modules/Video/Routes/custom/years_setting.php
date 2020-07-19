<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/20
 * Time: 下午 07:01
 */

use Modules\Video\Policies\YearsSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'video/years/setting',
        'namespace'  => 'Modules\Video\Http\Controllers'
    ], function () {
    Route::get('/', 'YearsSettingController@index')
        ->middleware('can:read,' . YearsSettingPolicy::class);
    Route::get('/total', 'YearsSettingController@total')
        ->middleware('can:read,' . YearsSettingPolicy::class);
    Route::post('/', 'YearsSettingController@store')
        ->middleware('can:create,' . YearsSettingPolicy::class);
    Route::get('/edit', 'YearsSettingController@edit')
        ->middleware('can:update,' . YearsSettingPolicy::class);
    Route::put('/', 'YearsSettingController@update')
        ->middleware('can:update,' . YearsSettingPolicy::class);
    Route::delete('/', 'YearsSettingController@delete')
        ->middleware('can:delete,' . YearsSettingPolicy::class);
});
