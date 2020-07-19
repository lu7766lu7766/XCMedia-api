<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/17
 * Time: 下午 02:39
 */

use Modules\Storytelling\Policies\RegionSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'storytelling/region/setting',
        'namespace'  => 'Modules\Storytelling\Http\Controllers'
    ],
    function () {
        Route::get('/', 'RegionSettingController@index')->middleware('can:read,' . RegionSettingPolicy::class);
        Route::get('/total', 'RegionSettingController@total')->middleware('can:read,' . RegionSettingPolicy::class);
        Route::get('/info', 'RegionSettingController@info')->middleware('can:create,' . RegionSettingPolicy::class);
        Route::post('/', 'RegionSettingController@store')->middleware('can:update,' . RegionSettingPolicy::class);
        Route::put('/', 'RegionSettingController@update')->middleware('can:update,' . RegionSettingPolicy::class);
        Route::delete('/', 'RegionSettingController@delete')->middleware('can:delete,' . RegionSettingPolicy::class);
    }
);
