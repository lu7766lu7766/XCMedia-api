<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 04:51
 */

use Modules\FAQ\Policies\ManageFAQPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'faq',
        'namespace'  => 'Modules\FAQ\Http\Controllers'
    ],
    function () {
        Route::get('manage', 'ManageFAQController@index')
            ->middleware('can:read,' . ManageFAQPolicy::class);
        Route::get('manage/total', 'ManageFAQController@total')
            ->middleware('can:read,' . ManageFAQPolicy::class);
        Route::post('manage', 'ManageFAQController@store')
            ->middleware('can:create,' . ManageFAQPolicy::class);
        Route::get('manage/edit', 'ManageFAQController@edit')
            ->middleware('can:update,' . ManageFAQPolicy::class);
        Route::put('manage', 'ManageFAQController@update')
            ->middleware('can:update,' . ManageFAQPolicy::class);
        Route::delete('manage', 'ManageFAQController@delete')
            ->middleware('can:delete,' . ManageFAQPolicy::class);
        Route::get('manage/options/branch', 'ManageFAQController@branch')
            ->middleware('can:branchList,' . ManageFAQPolicy::class);
        Route::group(['middleware' => 'can:editFile,' . ManageFAQPolicy::class,], function () {
            Route::post('manage/image/upload', 'ManageFAQController@uploadImage');
            Route::post('manage/image/remove', 'ManageFAQController@removeImage');
        });
    }
);
