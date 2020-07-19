<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 03:05
 */

use Modules\Collector\Policies\ManageCollectorPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'collector_setting',
        'namespace'  => 'Modules\Collector\Http\Controllers'
    ],
    function () {
        Route::group(['middleware' => 'can:read,' . ManageCollectorPolicy::class,], function () {
            Route::get('manage', 'ManageCollectorController@index');
            Route::get('manage/total', 'ManageCollectorController@total');
        });
        Route::group(['middleware' => 'can:update,' . ManageCollectorPolicy::class,], function () {
            Route::get('manage/edit', 'ManageCollectorController@edit');
            Route::put('manage', 'ManageCollectorController@update');
        });
        Route::post('manage', 'ManageCollectorController@store')
            ->middleware('can:create,' . ManageCollectorPolicy::class);
        Route::delete('manage', 'ManageCollectorController@delete')
            ->middleware('can:delete,' . ManageCollectorPolicy::class);
        Route::get('manage/get_source', 'ManageCollectorController@source');
        Route::get('manage/get_type', 'ManageCollectorController@type');
        Route::get('manage/get_platform', 'ManageCollectorController@platform');
    }
);
