<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/3
 * Time: 下午 02:50
 */

use Modules\Movie\Policies\RegionSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'movie/region/setting',
        'namespace'  => 'Modules\Movie\Http\Controllers'
    ],
    function () {
        Route::get('/', 'RegionSettingController@index')
            ->middleware('can:read,' . RegionSettingPolicy::class);
        Route::get('/total', 'RegionSettingController@total')
            ->middleware('can:read,' . RegionSettingPolicy::class);
        Route::post('/', 'RegionSettingController@store')
            ->middleware('can:create,' . RegionSettingPolicy::class);
        Route::get('/info', 'RegionSettingController@info')
            ->middleware('can:update,' . RegionSettingPolicy::class);
        Route::put('/', 'RegionSettingController@update')
            ->middleware('can:update,' . RegionSettingPolicy::class);
        Route::delete('/', 'RegionSettingController@delete')
            ->middleware('can:delete,' . RegionSettingPolicy::class);
    }
);
