<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 下午 02:21
 */

use Modules\Selfie\Policies\CupSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'selfie/cup/setting',
        'namespace'  => 'Modules\Selfie\Http\Controllers'
    ],
    function () {
        Route::get('/', 'CupSettingController@index')->middleware('can:read,' . CupSettingPolicy::class);
        Route::get('/total', 'CupSettingController@total')->middleware('can:read,' . CupSettingPolicy::class);
        Route::post('/', 'CupSettingController@store')->middleware('can:create,' . CupSettingPolicy::class);
        Route::get('/info', 'CupSettingController@info')->middleware('can:update,' . CupSettingPolicy::class);
        Route::put('/', 'CupSettingController@update')->middleware('can:update,' . CupSettingPolicy::class);
        Route::delete('/', 'CupSettingController@delete')->middleware('can:delete,' . CupSettingPolicy::class);
    }
);
