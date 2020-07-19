<?php

use Modules\Comic\Policies\ManageComicPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'comic/manage',
        'namespace'  => 'Modules\Comic\Http\Controllers'
    ],
    function () {
        Route::get('/', 'ManageComicController@index')->middleware('can:read,' . ManageComicPolicy::class);
        Route::get('/total', 'ManageComicController@total')->middleware('can:read,' . ManageComicPolicy::class);
        Route::post('/', 'ManageComicController@store')->middleware('can:create,' . ManageComicPolicy::class);
        Route::get('/edit', 'ManageComicController@edit')->middleware('can:update,' . ManageComicPolicy::class);
        Route::post('/update', 'ManageComicController@update')->middleware('can:update,' . ManageComicPolicy::class);
        Route::delete('/', 'ManageComicController@delete')->middleware('can:delete,' . ManageComicPolicy::class);
        Route::group(['middleware' => 'can:editFile,' . ManageComicPolicy::class,], function () {
            Route::post('image/upload', 'ManageComicController@uploadImage');
            Route::post('image/remove', 'ManageComicController@removeImage');
        });
        Route::group(['prefix' => 'episode'], function () {
            Route::get('/', 'ManageComicController@episodeList')
                ->middleware('can:episodeRead,' . ManageComicPolicy::class);
            Route::get('/total', 'ManageComicController@episodeTotal')
                ->middleware('can:episodeRead,' . ManageComicPolicy::class);
            Route::post('/', 'ManageComicController@episodeCreate')
                ->middleware('can:episodeCreate,' . ManageComicPolicy::class);
            Route::get('/edit', 'ManageComicController@episodeEdit')
                ->middleware('can:episodeUpdate,' . ManageComicPolicy::class);
            Route::put('/update', 'ManageComicController@episodeUpdate')
                ->middleware('can:episodeUpdate,' . ManageComicPolicy::class);
            Route::delete('/', 'ManageComicController@episodeDelete')
                ->middleware('can:episodeDelete,' . ManageComicPolicy::class);
            Route::group(['middleware' => 'can:editEpisodeFile,' . ManageComicPolicy::class,], function () {
                Route::post('image/upload', 'ManageComicController@uploadEpisodeImage');
                Route::post('image/remove', 'ManageComicController@removeEpisodeImage');
            });
        });
        Route::group(['prefix' => 'options'], function () {
            Route::get('/get_region', 'ManageComicController@getRegion')
                ->middleware('can:options,' . ManageComicPolicy::class);
            Route::get('/get_years', 'ManageComicController@getYears')
                ->middleware('can:options,' . ManageComicPolicy::class);
            Route::get('/get_genres', 'ManageComicController@getGenres')
                ->middleware('can:options,' . ManageComicPolicy::class);
        });
    }
);
