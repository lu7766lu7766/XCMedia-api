<?php
/**
 * 站台管理
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/2
 * Time: 下午 03:56
 */

use Modules\Branch\Policies\ManageBranchPolicy;

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'branch',
        'namespace'  => 'Modules\Branch\Http\Controllers'
    ],
    function () {
        Route::get('manage', 'ManageBranchController@index')
            ->middleware('can:read,' . ManageBranchPolicy::class);
        Route::get('manage/total', 'ManageBranchController@total')
            ->middleware('can:read,' . ManageBranchPolicy::class);
        Route::post('manage', 'ManageBranchController@store')
            ->middleware('can:create,' . ManageBranchPolicy::class);
        Route::put('manage', 'ManageBranchController@update')
            ->middleware('can:update,' . ManageBranchPolicy::class);
        Route::delete('manage', 'ManageBranchController@delete')
            ->middleware('can:delete,' . ManageBranchPolicy::class);
    }
);
