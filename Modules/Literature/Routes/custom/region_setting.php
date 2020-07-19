<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/5
 * Time: 下午 07:39
 */

use Modules\Literature\Policies\RegionSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'literature/region/setting',
        'namespace'  => 'Modules\Literature\Http\Controllers'
    ],
    function () {
        Route::get('/', 'RegionSettingController@index')->middleware('can:read,' . RegionSettingPolicy::class);
        Route::get('/total', 'RegionSettingController@total')->middleware('can:read,' . RegionSettingPolicy::class);
        Route::post('/', 'RegionSettingController@store')->middleware('can:create,' . RegionSettingPolicy::class);
        Route::get('/info', 'RegionSettingController@info')->middleware('can:update,' . RegionSettingPolicy::class);
        Route::put('/', 'RegionSettingController@update')->middleware('can:update,' . RegionSettingPolicy::class);
        Route::delete('/', 'RegionSettingController@delete')->middleware('can:delete,' . RegionSettingPolicy::class);
    }
);
