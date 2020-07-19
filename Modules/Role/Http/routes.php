<?php

use Modules\Role\Policies\PublicRolePolicy;

Route::group(
    ['middleware' => 'api', 'prefix' => 'role', 'namespace' => 'Modules\Role\Http\Controllers'],
    function () {
        Route::group(['middleware' => 'can:manageRead,' . PublicRolePolicy::class], function () {
            Route::post('public/index', 'PublicRoleController@index')->name('public_role_index');
            Route::post('public/total', 'PublicRoleController@total')->name('public_role_total');
            Route::get('public/{id}', 'PublicRoleController@info')->name('custom_role_info');
        });
        Route::post('custom/create', 'CustomRoleController@create')->name('custom_role_create')
            ->middleware('can:manageCreate,' . PublicRolePolicy::class);
        Route::post('custom/edit', 'CustomRoleController@edit')->name('custom_role_edit')
            ->middleware('can:manageUpdate,' . PublicRolePolicy::class);
        Route::delete('custom/delete/{id}', 'CustomRoleController@delete')->name('custom_role_delete')
            ->middleware('can:manageDel,' . PublicRolePolicy::class);
        Route::group(['middleware' => 'can:authorization,' . PublicRolePolicy::class], function () {
            Route::get('public/authorized/node', 'PublicRoleController@authorizedNodes')->name('public_role_node_map');
            Route::post('public/node/map', 'PublicRoleController@nodeMap')->name('public_role_node_map');
            Route::post('public/node/bind', 'PublicRoleController@authorization')->name('public_role_bind_node');
        });
    }
);

