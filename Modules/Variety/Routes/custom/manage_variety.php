<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/17
 * Time: 下午 05:25
 */

use Modules\Variety\Policies\ManageVarietyPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'variety/manage',
    'namespace'  => 'Modules\Variety\Http\Controllers'
], function () {
    Route::get('/', 'ManageVarietyController@index')->middleware('can:read,' . ManageVarietyPolicy::class);
    Route::get('/total', 'ManageVarietyController@total')->middleware('can:read,' . ManageVarietyPolicy::class);
    Route::post('/', 'ManageVarietyController@store')->middleware('can:create,' . ManageVarietyPolicy::class);
    Route::get('/edit', 'ManageVarietyController@edit')->middleware('can:update,' . ManageVarietyPolicy::class);
    Route::post('/update', 'ManageVarietyController@update')->middleware('can:update,' . ManageVarietyPolicy::class);
    Route::delete('/', 'ManageVarietyController@delete')->middleware('can:delete,' . ManageVarietyPolicy::class);
    Route::group(['middleware' => 'can:editFile,' . ManageVarietyPolicy::class], function () {
        Route::post('image/upload', 'ManageVarietyController@uploadImage');
        Route::post('image/remove', 'ManageVarietyController@removeImage');
    });
    Route::group(['prefix' => 'episode'], function () {
        Route::get('/', 'ManageVarietyController@episodeList')
            ->middleware('can:episodeRead,' . ManageVarietyPolicy::class);
        Route::get('/total', 'ManageVarietyController@episodeTotal')
            ->middleware('can:episodeRead,' . ManageVarietyPolicy::class);
        Route::post('/', 'ManageVarietyController@episodeCreate')
            ->middleware('can:episodeCreate,' . ManageVarietyPolicy::class);
        Route::get('/edit', 'ManageVarietyController@episodeEdit')
            ->middleware('can:episodeUpdate,' . ManageVarietyPolicy::class);
        Route::put('/update', 'ManageVarietyController@episodeUpdate')
            ->middleware('can:episodeUpdate,' . ManageVarietyPolicy::class);
        Route::delete('/', 'ManageVarietyController@episodeDelete')
            ->middleware('can:episodeDelete,' . ManageVarietyPolicy::class);
        Route::get('options/get_source', 'ManageVarietyController@getSource');
        Route::post('/batch', 'ManageVarietyController@episodeBatchUpdateOrCreate')
            ->middleware('can:episodeCreate,' . ManageVarietyPolicy::class);
    });
    Route::group(['prefix' => 'options'], function () {
        Route::get('/episode_status', 'ManageVarietyController@getEpisodeStatus');
        Route::get('/get_region', 'ManageVarietyController@getRegion');
        Route::get('/get_years', 'ManageVarietyController@getYears');
        Route::get('/get_language', 'ManageVarietyController@getLanguage');
        Route::get('/get_genres', 'ManageVarietyController@getGenres');
    });
});
