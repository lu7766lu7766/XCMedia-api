<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/14
 * Time: 下午 04:59
 */

use Modules\Anime\Policies\ManageAnimePolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'anime/manage',
    'namespace'  => 'Modules\Anime\Http\Controllers'
], function () {
    Route::get('/', 'ManageAnimeController@index')->middleware('can:read,' . ManageAnimePolicy::class);
    Route::get('/total', 'ManageAnimeController@total')->middleware('can:read,' . ManageAnimePolicy::class);
    Route::post('/', 'ManageAnimeController@store')->middleware('can:create,' . ManageAnimePolicy::class);
    Route::get('/edit', 'ManageAnimeController@edit')->middleware('can:update,' . ManageAnimePolicy::class);
    Route::post('/update', 'ManageAnimeController@update')->middleware('can:update,' . ManageAnimePolicy::class);
    Route::delete('/', 'ManageAnimeController@delete')->middleware('can:delete,' . ManageAnimePolicy::class);
    Route::group(['middleware' => 'can:editFile,' . ManageAnimePolicy::class], function () {
        Route::post('image/upload', 'ManageAnimeController@uploadImage');
        Route::post('image/remove', 'ManageAnimeController@removeImage');
    });
    Route::group(['prefix' => 'episode'], function () {
        Route::get('/', 'ManageAnimeController@episodeList')
            ->middleware('can:episodeRead,' . ManageAnimePolicy::class);
        Route::get('/total', 'ManageAnimeController@episodeTotal')
            ->middleware('can:episodeRead,' . ManageAnimePolicy::class);
        Route::post('/', 'ManageAnimeController@episodeCreate')
            ->middleware('can:episodeCreate,' . ManageAnimePolicy::class);
        Route::get('/edit', 'ManageAnimeController@episodeEdit')
            ->middleware('can:episodeUpdate,' . ManageAnimePolicy::class);
        Route::put('/update', 'ManageAnimeController@episodeUpdate')
            ->middleware('can:episodeUpdate,' . ManageAnimePolicy::class);
        Route::delete('/', 'ManageAnimeController@episodeDelete')
            ->middleware('can:episodeDelete,' . ManageAnimePolicy::class);
        Route::get('options/get_source', 'ManageAnimeController@getSource');
        Route::post('/batch', 'ManageAnimeController@episodeBatchUpdateOrCreate')
            ->middleware('can:episodeCreate,' . ManageAnimePolicy::class);
    });
    Route::group(['prefix' => 'options'], function () {
        Route::get('/episode_status', 'ManageAnimeController@getEpisodeStatus');
        Route::get('/get_region', 'ManageAnimeController@getRegion');
        Route::get('/get_years', 'ManageAnimeController@getYears');
        Route::get('/get_language', 'ManageAnimeController@getLanguage');
        Route::get('/get_genres', 'ManageAnimeController@getGenres');
    });
});
