<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/13
 * Time: 上午 11:50
 */

use Modules\Storytelling\Policies\ManageStorytellingAudioPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'manage/storytelling/audio',
    'namespace'  => 'Modules\Storytelling\Http\Controllers'
], function () {
    Route::get('/', 'ManageStorytellingAudioController@index')
        ->middleware('can:read,' . ManageStorytellingAudioPolicy::class);
    Route::get('/total', 'ManageStorytellingAudioController@total')
        ->middleware('can:read,' . ManageStorytellingAudioPolicy::class);
    Route::post('/', 'ManageStorytellingAudioController@store')
        ->middleware('can:create,' . ManageStorytellingAudioPolicy::class);
    Route::delete('/', 'ManageStorytellingAudioController@delete')
        ->middleware('can:delete,' . ManageStorytellingAudioPolicy::class);
});
