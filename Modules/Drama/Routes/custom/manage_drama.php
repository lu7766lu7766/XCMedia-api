<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/10
 * Time: 下午 02:05
 */

use Modules\Drama\Policies\ManageDramaPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'drama/manage',
    'namespace'  => 'Modules\Drama\Http\Controllers'
], function () {
    Route::get('/', 'ManageDramaController@index')->middleware('can:read,' . ManageDramaPolicy::class);
    Route::get('/total', 'ManageDramaController@total')->middleware('can:read,' . ManageDramaPolicy::class);
    Route::post('/', 'ManageDramaController@store')->middleware('can:create,' . ManageDramaPolicy::class);
    Route::get('/edit', 'ManageDramaController@edit')->middleware('can:update,' . ManageDramaPolicy::class);
    Route::post('/update', 'ManageDramaController@update')->middleware('can:update,' . ManageDramaPolicy::class);
    Route::delete('/', 'ManageDramaController@delete')->middleware('can:delete,' . ManageDramaPolicy::class);
    Route::group(['middleware' => 'can:editFile,' . ManageDramaPolicy::class], function () {
        Route::post('image/upload', 'ManageDramaController@uploadImage');
        Route::post('image/remove', 'ManageDramaController@removeImage');
    });
    Route::group(['prefix' => 'episode'], function () {
        Route::get('/', 'ManageDramaController@episodeList')
            ->middleware('can:episodeRead,' . ManageDramaPolicy::class);
        Route::get('/total', 'ManageDramaController@episodeTotal')
            ->middleware('can:episodeRead,' . ManageDramaPolicy::class);
        Route::post('/', 'ManageDramaController@episodeCreate')
            ->middleware('can:episodeCreate,' . ManageDramaPolicy::class);
        Route::get('/edit', 'ManageDramaController@episodeEdit')
            ->middleware('can:episodeUpdate,' . ManageDramaPolicy::class);
        Route::put('/update', 'ManageDramaController@episodeUpdate')
            ->middleware('can:episodeUpdate,' . ManageDramaPolicy::class);
        Route::delete('/', 'ManageDramaController@episodeDelete')
            ->middleware('can:episodeDelete,' . ManageDramaPolicy::class);
        Route::get('options/get_source', 'ManageDramaController@getSource');
        Route::post('/batch', 'ManageDramaController@episodeBatchUpdateOrCreate')
            ->middleware('can:episodeCreate,' . ManageDramaPolicy::class);
    });
    Route::group(['prefix' => 'options'], function () {
        Route::get('/episode_status', 'ManageDramaController@getEpisodeStatus');
        Route::get('/get_region', 'ManageDramaController@getRegion');
        Route::get('/get_years', 'ManageDramaController@getYears');
        Route::get('/get_language', 'ManageDramaController@getLanguage');
        Route::get('/get_genres', 'ManageDramaController@getGenres');
    });
});
