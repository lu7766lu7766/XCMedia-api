<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/15
 * Time: 下午 02:58
 */

use Modules\Layout\Policies\ManageLayoutPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'layout',
        'namespace'  => 'Modules\Layout\Http\Controllers'
    ],
    function () {
        Route::get('manage', 'ManageLayoutController@index')
            ->middleware('can:read,' . ManageLayoutPolicy::class);
        Route::get('manage/total', 'ManageLayoutController@total')
            ->middleware('can:read,' . ManageLayoutPolicy::class);
        Route::post('manage', 'ManageLayoutController@store')
            ->middleware('can:create,' . ManageLayoutPolicy::class);
        Route::get('manage/edit', 'ManageLayoutController@edit')
            ->middleware('can:update,' . ManageLayoutPolicy::class);
        Route::put('manage', 'ManageLayoutController@update')
            ->middleware('can:update,' . ManageLayoutPolicy::class);
        Route::delete('manage', 'ManageLayoutController@delete')
            ->middleware('can:delete,' . ManageLayoutPolicy::class);
        Route::get('manage/options/branch', 'ManageLayoutController@branch')
            ->middleware('can:branchList,' . ManageLayoutPolicy::class);
        Route::group(['middleware' => 'can:editFile,' . ManageLayoutPolicy::class,], function () {
            Route::post('manage/image/upload', 'ManageLayoutController@uploadImage');
            Route::post('manage/image/remove', 'ManageLayoutController@removeImage');
        });
    }
);
