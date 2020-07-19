<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/17
 * Time: 下午 03:42
 */

use Modules\Drama\Policies\SourceSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'drama/source/setting',
        'namespace'  => 'Modules\Drama\Http\Controllers'
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
