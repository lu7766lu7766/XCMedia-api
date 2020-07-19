<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 下午 01:37
 */

use Modules\ShortFilm\Policies\CupSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'short_film/cup/setting',
        'namespace'  => 'Modules\ShortFilm\Http\Controllers'
    ],
    function () {
        Route::get('/', 'CupSettingController@index')->middleware('can:read,' . CupSettingPolicy::class);
        Route::get('/total', 'CupSettingController@total')->middleware('can:read,' . CupSettingPolicy::class);
        Route::get('/info', 'CupSettingController@info')->middleware('can:create,' . CupSettingPolicy::class);
        Route::post('/', 'CupSettingController@store')->middleware('can:update,' . CupSettingPolicy::class);
        Route::put('/', 'CupSettingController@update')->middleware('can:update,' . CupSettingPolicy::class);
        Route::delete('/', 'CupSettingController@delete')->middleware('can:delete,' . CupSettingPolicy::class);
    }
);
