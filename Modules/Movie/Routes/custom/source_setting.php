<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/17
 * Time: 下午 03:42
 */

use Modules\Movie\Policies\SourceSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'movie/source/setting',
        'namespace'  => 'Modules\Movie\Http\Controllers'
    ], function () {
    Route::get('/', 'SourceSettingController@index')
        ->middleware('can:read,' . SourceSettingPolicy::class);
    Route::get('/total', 'SourceSettingController@total')
        ->middleware('can:read,' . SourceSettingPolicy::class);
    Route::post('/', 'SourceSettingController@store')
        ->middleware('can:create,' . SourceSettingPolicy::class);
    Route::get('/edit', 'SourceSettingController@edit')
        ->middleware('can:update,' . SourceSettingPolicy::class);
    Route::put('/', 'SourceSettingController@update')
        ->middleware('can:update,' . SourceSettingPolicy::class);
    Route::delete('/', 'SourceSettingController@delete')
        ->middleware('can:delete,' . SourceSettingPolicy::class);
});
