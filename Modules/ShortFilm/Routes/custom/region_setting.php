<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/4
 * Time: 下午 03:35
 */

use Modules\ShortFilm\Policies\RegionSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'short_film/region/setting',
        'namespace'  => 'Modules\ShortFilm\Http\Controllers'
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
