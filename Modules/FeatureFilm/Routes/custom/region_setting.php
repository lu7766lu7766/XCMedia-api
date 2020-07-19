<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/4
 * Time: 下午 02:32
 */

use Modules\FeatureFilm\Policies\RegionSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'feature_film/region/setting',
        'namespace'  => 'Modules\FeatureFilm\Http\Controllers'
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
