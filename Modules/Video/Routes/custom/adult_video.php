<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/3
 * Time: 下午 06:37
 */

use Modules\Video\Policies\AdultVideoPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'manage/adult_video',
        'namespace'  => 'Modules\Video\Http\Controllers'
    ],
    function () {
        Route::get('/', 'ManageAdultVideoController@index')->middleware('can:read,' . AdultVideoPolicy::class);
        Route::get('/total', 'ManageAdultVideoController@total')->middleware('can:read,' . AdultVideoPolicy::class);
        Route::post('/', 'ManageAdultVideoController@store')->middleware('can:create,' . AdultVideoPolicy::class);
        Route::get('/info', 'ManageAdultVideoController@info')->middleware('can:create,' . AdultVideoPolicy::class);
        Route::post('/update', 'ManageAdultVideoController@update')
            ->middleware('can:update,' . AdultVideoPolicy::class);
        Route::delete('/', 'ManageAdultVideoController@delete')->middleware('can:delete,' . AdultVideoPolicy::class);
        Route::get('/region', 'ManageAdultVideoController@region')->middleware('can:read,' . AdultVideoPolicy::class);
        Route::get('/actress', 'ManageAdultVideoController@actress')->middleware('can:read,' . AdultVideoPolicy::class);
        Route::get('/cup', 'ManageAdultVideoController@cup')->middleware('can:read,' . AdultVideoPolicy::class);
        Route::get('/genres', 'ManageAdultVideoController@genres')->middleware('can:read,' . AdultVideoPolicy::class);
        Route::get('/years', 'ManageAdultVideoController@years')->middleware('can:read,' . AdultVideoPolicy::class);
        Route::post('/upload', 'ManageAdultVideoController@upload')
            ->middleware('can:create,' . AdultVideoPolicy::class);
    }
);
