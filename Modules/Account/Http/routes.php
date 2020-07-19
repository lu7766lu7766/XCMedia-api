<?php

use Modules\Account\Policies\AccountPolicy;

Route::group(
    ['middleware' => 'api', 'prefix' => 'account', 'namespace' => 'Modules\Account\Http\Controllers'],
    function () {
        // 帳號管理
        Route::group(['prefix' => 'manage'], function () {
            Route::group(['middleware' => 'can:manageRead,' . AccountPolicy::class], function () {
                Route::post('list', 'ManageAccountController@index')->name('account_manage_list');
                Route::post('total', 'ManageAccountController@total')->name('account_manage_list_total');
                Route::get('options', 'ManageAccountController@options')->name('account_manage_options');
            });
            Route::post('create', 'ManageAccountController@create')->name('account_manage_create')
                ->middleware('can:manageCreate,' . AccountPolicy::class);
            Route::post('update', 'ManageAccountController@update')->name('account_manage_update')
                ->middleware('can:manageUpdate,' . AccountPolicy::class);
            Route::delete('delete/{id}', 'ManageAccountController@delete')->name('account_manage_delete')
                ->middleware('can:manageDel,' . AccountPolicy::class);
        });
        // 登入者
        Route::group(['prefix' => 'pilot'], function () {
            Route::get('profile', 'PilotController@profile');
            Route::post('profile/edit', 'PilotController@edit');
            Route::get('nodes', 'PilotController@nodes');
        });
        // 帳號登入歷程
        Route::group(
            ['prefix' => 'login/history', 'middleware' => 'can:loginHistoryRead,' . AccountPolicy::class],
            function () {
                Route::post('/list', 'AccountLoginHistoryController@index');
                Route::post('/total', 'AccountLoginHistoryController@total');
                Route::get('/options', 'AccountLoginHistoryController@options');
            }
        );
    }
);

