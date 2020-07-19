<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/8
 * Time: 下午 07:33
 */

use Modules\Advertisement\Policies\ManageAdvertisementPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'advertisement',
        'namespace'  => 'Modules\Advertisement\Http\Controllers'
    ],
    function () {
        Route::get('manage', 'ManageAdvertisementController@index')
            ->middleware('can:read,' . ManageAdvertisementPolicy::class);
        Route::get('manage/total', 'ManageAdvertisementController@total')
            ->middleware('can:read,' . ManageAdvertisementPolicy::class);
        Route::post('manage', 'ManageAdvertisementController@store')
            ->middleware('can:create,' . ManageAdvertisementPolicy::class);
        Route::get('manage/edit', 'ManageAdvertisementController@edit')
            ->middleware('can:update,' . ManageAdvertisementPolicy::class);
        Route::post('manage/update', 'ManageAdvertisementController@update')
            ->middleware('can:update,' . ManageAdvertisementPolicy::class);
        Route::delete('manage', 'ManageAdvertisementController@delete')
            ->middleware('can:delete,' . ManageAdvertisementPolicy::class);
        Route::get('manage/options/branch', 'ManageAdvertisementController@branch')
            ->middleware('can:branchList,' . ManageAdvertisementPolicy::class);
        Route::get('manage/options/type', 'ManageAdvertisementController@type');
    }
);
