<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/15
 * Time: 下午 02:21
 */
Route::group(
    [
        'middleware' => ['debug_cnf', 'cros', 'json_response'],
        'prefix'     => 'client',
        'namespace'  => 'Modules\Member\Http\Controllers'
    ],
    function () {
        Route::post('/register', 'MemberController@register')->middleware('throttle:60,1');
        Route::post('register/send_verification_code', 'MemberController@sendVerificationCode')
            ->middleware('throttle:60,1');
        Route::get('/logout', 'MemberController@logout')->middleware('auth:client_api');
    }
);
