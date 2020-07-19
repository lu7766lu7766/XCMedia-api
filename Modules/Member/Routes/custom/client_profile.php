<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/18
 * Time: 下午 03:18
 */
Route::group(
    [
        'middleware' => 'client_api',
        'prefix'     => 'client/profile',
        'namespace'  => 'Modules\Member\Http\Controllers'
    ],
    function () {
        Route::get('/', 'ProfileController@info');
        Route::put('/', 'ProfileController@update');
        Route::put('/password', 'ProfileController@updatePassword');
    }
);
