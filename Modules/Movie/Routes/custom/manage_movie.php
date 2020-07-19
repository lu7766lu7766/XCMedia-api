<?php

use Modules\Movie\Policies\ManageMoviePolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'movie/manage',
        'namespace'  => 'Modules\Movie\Http\Controllers'
    ],
    function () {
        Route::get('/', 'ManageMovieController@index')->middleware('can:read,' . ManageMoviePolicy::class);
        Route::get('/total', 'ManageMovieController@total')->middleware('can:read,' . ManageMoviePolicy::class);
        Route::post('/', 'ManageMovieController@store')->middleware('can:create,' . ManageMoviePolicy::class);
        Route::get('/edit', 'ManageMovieController@info')->middleware('can:update,' . ManageMoviePolicy::class);
        Route::post('/update', 'ManageMovieController@update')->middleware('can:update,' . ManageMoviePolicy::class);
        Route::delete('/', 'ManageMovieController@delete')->middleware('can:delete,' . ManageMoviePolicy::class);
        Route::group(['middleware' => 'can:editFile,' . ManageMoviePolicy::class,], function () {
            Route::post('image/upload', 'ManageMovieController@uploadImage');
            Route::post('image/remove', 'ManageMovieController@removeImage');
        });
        Route::group(['prefix' => 'episode'], function () {
            Route::get('/', 'ManageMovieController@episodeList')
                ->middleware('can:episodeRead,' . ManageMoviePolicy::class);
            Route::get('/total', 'ManageMovieController@episodeTotal')
                ->middleware('can:episodeRead,' . ManageMoviePolicy::class);
            Route::post('/', 'ManageMovieController@episodeCreate')
                ->middleware('can:episodeCreate,' . ManageMoviePolicy::class);
            Route::get('/edit', 'ManageMovieController@episodeEdit')
                ->middleware('can:episodeUpdate,' . ManageMoviePolicy::class);
            Route::put('/update', 'ManageMovieController@episodeUpdate')
                ->middleware('can:episodeUpdate,' . ManageMoviePolicy::class);
            Route::delete('/', 'ManageMovieController@episodeDelete')
                ->middleware('can:episodeDelete,' . ManageMoviePolicy::class);
            Route::get('options/get_source', 'ManageMovieController@getSource');
            Route::post('/batch', 'ManageMovieController@episodeBatchUpdateOrCreate')
                ->middleware('can:episodeCreate,' . ManageMoviePolicy::class);
        });
        Route::group(['prefix' => 'options'], function () {
            Route::get('/get_region', 'ManageMovieController@getRegion');
            Route::get('/get_years', 'ManageMovieController@getYears');
            Route::get('/get_language', 'ManageMovieController@getLanguage');
            Route::get('/get_genres', 'ManageMovieController@getGenres');
        });
    }
);
