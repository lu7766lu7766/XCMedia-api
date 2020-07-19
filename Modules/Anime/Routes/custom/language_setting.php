<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/17
 * Time: 下午 03:42
 */

use Modules\Anime\Policies\LanguageSettingPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'anime/language/setting',
        'namespace'  => 'Modules\Anime\Http\Controllers'
    ], function () {
    Route::get('/', 'LanguageSettingController@index')
        ->middleware('can:read,' . LanguageSettingPolicy::class);
    Route::get('/total', 'LanguageSettingController@total')
        ->middleware('can:read,' . LanguageSettingPolicy::class);
    Route::post('/', 'LanguageSettingController@store')
        ->middleware('can:create,' . LanguageSettingPolicy::class);
    Route::get('/edit', 'LanguageSettingController@edit')
        ->middleware('can:update,' . LanguageSettingPolicy::class);
    Route::put('/', 'LanguageSettingController@update')
        ->middleware('can:update,' . LanguageSettingPolicy::class);
    Route::delete('/', 'LanguageSettingController@delete')
        ->middleware('can:delete,' . LanguageSettingPolicy::class);
});
