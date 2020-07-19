<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 03:52
 */

use Modules\ShortFilm\Policies\AVActressSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'selfie/av_actress/setting',
        'namespace'  => 'Modules\Selfie\Http\Controllers'
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
