<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 02:24
 */

use Modules\ShortFilm\Policies\ManageShortFilmPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'short_film/manage',
    'namespace'  => 'Modules\ShortFilm\Http\Controllers'
], function () {
    Route::group([
        'middleware' => 'can:read,' . ManageShortFilmPolicy::class,
    ], function () {
        Route::get('/', 'ManageShortFilmController@list');
        Route::get('/total', 'ManageShortFilmController@total');
        Route::get('/options/get_year', 'ManageShortFilmController@getYears');
        Route::get('/options/get_region', 'ManageShortFilmController@getRegion');
        Route::get('/options/get_genres', 'ManageShortFilmController@getGenres');
        Route::get('/options/get_av_actress', 'ManageShortFilmController@getAVActress');
        Route::get('/options/get_cup', 'ManageShortFilmController@getCup');
    });
    Route::group([
        'middleware' => 'can:upload,' . ManageShortFilmPolicy::class
    ], function () {
        Route::post('/image', 'ManageShortFilmController@uploadEditorFile');
        Route::delete('/image', 'ManageShortFilmController@deleteEditorFile');
    });
    Route::post('/', 'ManageShortFilmController@add')
        ->middleware('can:add,' . ManageShortFilmPolicy::class);
    Route::post('/edit', 'ManageShortFilmController@edit')
        ->middleware('can:edit,' . ManageShortFilmPolicy::class);
    Route::delete('/', 'ManageShortFilmController@delete')
        ->middleware('can:delete,' . ManageShortFilmPolicy::class);
    Route::post('/video_manage', 'ManageShortFilmController@editVideo')
        ->middleware('can:video,' . ManageShortFilmPolicy::class);
});
