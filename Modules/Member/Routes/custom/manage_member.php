<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 02:47
 */

use Modules\Member\Policies\ManageMemberPolicy;

Route::group(
    ['middleware' => 'api', 'prefix' => 'member', 'namespace' => 'Modules\Member\Http\Controllers'],
    function () {
        // 會員帳號管理
        Route::group(['prefix' => 'manage'], function () {
            Route::group(['middleware' => 'can:read,' . ManageMemberPolicy::class], function () {
                Route::post('list', 'ManageMemberController@list')->name('member_manage_list');
                Route::post('total', 'ManageMemberController@total')->name('member_manage_list_total');
                Route::post('profile', 'ManageMemberController@profile')->name('member_manage_profile');
            });
            Route::group(['middleware' => 'can:optionsList,' . ManageMemberPolicy::class], function () {
                Route::get('options/status', 'ManageMemberController@statusList')->name('member_manage_options_status');
                Route::get('options/branch', 'ManageMemberController@branchList')->name('member_manage_options_branch');
            });
            Route::post('create', 'ManageMemberController@create')->name('member_manage_create')
                ->middleware('can:create,' . ManageMemberPolicy::class);
            Route::post('update', 'ManageMemberController@update')->name('member_manage_update')
                ->middleware('can:update,' . ManageMemberPolicy::class);
            Route::post('delete', 'ManageMemberController@delete')->name('member_manage_delete')
                ->middleware('can:delete,' . ManageMemberPolicy::class);
        });
        // 帳號登入歷程
        Route::group(
            ['prefix' => 'login/history', 'middleware' => 'can:history,' . ManageMemberPolicy::class],
            function () {
                Route::post('personal/list', 'MemberLoginHistoryController@personalList');
                Route::post('personal/total', 'MemberLoginHistoryController@personaltotal');
                Route::post('list', 'MemberLoginHistoryController@list');
                Route::post('total', 'MemberLoginHistoryController@total');
                Route::post('info', 'MemberLoginHistoryController@info');
                Route::get('options/branch', 'MemberLoginHistoryController@branchList');
            }
        );
    }
);
