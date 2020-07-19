<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 02:24
 */

use Modules\FeatureFilm\Policies\ManageFeatureFilmPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'feature_film/manage',
    'namespace'  => 'Modules\FeatureFilm\Http\Controllers'
], function () {
    Route::group([
        'middleware' => 'can:read,' . ManageFeatureFilmPolicy::class,
    ], function () {
        Route::get('/', 'ManageFeatureFilmController@list');
        Route::get('/total', 'ManageFeatureFilmController@total');
        Route::get('/options/get_year', 'ManageFeatureFilmController@getYears');
        Route::get('/options/get_region', 'ManageFeatureFilmController@getRegion');
        Route::get('/options/get_genres', 'ManageFeatureFilmController@getGenres');
        Route::get('/options/get_av_actress', 'ManageFeatureFilmController@getAVActress');
        Route::get('/options/get_cup', 'ManageFeatureFilmController@getCup');
    });
    Route::group([
        'middleware' => 'can:upload,' . ManageFeatureFilmPolicy::class
    ], function () {
        Route::post('/upload', 'ManageFeatureFilmController@uploadEditorFile');
        Route::delete('/upload', 'ManageFeatureFilmController@deleteEditorFile');
    });
    Route::post('/', 'ManageFeatureFilmController@add')
        ->middleware('can:add,' . ManageFeatureFilmPolicy::class);
    Route::post('/edit', 'ManageFeatureFilmController@edit')
        ->middleware('can:edit,' . ManageFeatureFilmPolicy::class);
    Route::delete('/', 'ManageFeatureFilmController@delete')
        ->middleware('can:delete,' . ManageFeatureFilmPolicy::class);
    Route::post('/video_manage', 'ManageFeatureFilmController@editVideo')
        ->middleware('can:video,' . ManageFeatureFilmPolicy::class);
});
