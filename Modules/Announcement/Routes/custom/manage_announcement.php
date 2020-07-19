<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/6
 * Time: 下午 06:47
 */

use Modules\Announcement\Policies\ManageAnnouncementPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'announcement',
        'namespace'  => 'Modules\Announcement\Http\Controllers'
    ],
    function () {
        Route::get('manage', 'ManageAnnouncementController@index')
            ->middleware('can:read,' . ManageAnnouncementPolicy::class);
        Route::get('manage/total', 'ManageAnnouncementController@total')
            ->middleware('can:read,' . ManageAnnouncementPolicy::class);
        Route::post('manage', 'ManageAnnouncementController@store')
            ->middleware('can:create,' . ManageAnnouncementPolicy::class);
        Route::get('manage/edit', 'ManageAnnouncementController@edit')
            ->middleware('can:update,' . ManageAnnouncementPolicy::class);
        Route::put('manage', 'ManageAnnouncementController@update')
            ->middleware('can:update,' . ManageAnnouncementPolicy::class);
        Route::delete('manage', 'ManageAnnouncementController@delete')
            ->middleware('can:delete,' . ManageAnnouncementPolicy::class);
        Route::get('manage/options/branch', 'ManageAnnouncementController@branch')
            ->middleware('can:branchList,' . ManageAnnouncementPolicy::class);
        Route::group(['middleware' => 'can:editFile,' . ManageAnnouncementPolicy::class,], function () {
            Route::post('manage/image/upload', 'ManageAnnouncementController@uploadImage');
            Route::post('manage/image/remove', 'ManageAnnouncementController@removeImage');
        });
    }
);
