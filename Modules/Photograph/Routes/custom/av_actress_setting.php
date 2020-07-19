<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 04:12
 */

use Modules\Photograph\Policies\AVActressSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'photograph/av_actress/setting',
        'namespace'  => 'Modules\Photograph\Http\Controllers'
    ],
    function () {
        Route::get('/', 'AVActressSettingController@index')
            ->middleware('can:read,' . AVActressSettingPolicy::class);
        Route::get('/total', 'AVActressSettingController@total')
            ->middleware('can:read,' . AVActressSettingPolicy::class);
        Route::post('/', 'AVActressSettingController@store')
            ->middleware('can:create,' . AVActressSettingPolicy::class);
        Route::get('/info', 'AVActressSettingController@info')
            ->middleware('can:update,' . AVActressSettingPolicy::class);
        Route::post('/update', 'AVActressSettingController@update')
            ->middleware('can:update,' . AVActressSettingPolicy::class);
        Route::delete('/', 'AVActressSettingController@delete')
            ->middleware('can:delete,' . AVActressSettingPolicy::class);
    }
);
