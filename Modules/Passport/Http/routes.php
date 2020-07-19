<?php
Route::group(
    [
        'middleware' => ['cros', 'throttle:120,1'],
        'prefix'     => 'passport',
        'namespace'  => 'Modules\Passport\Http\Controllers'
    ],
    function () {
        Route::post('/login', [
            'uses'       => 'PassportController@issueToken',
            'middleware' => ['debug_cnf', 'json_response'],
        ])->name('passport.login');
        Route::post('member/login', [
            'uses'       => 'PassportController@memberIssueToken',
            'middleware' => ['debug_cnf', 'json_response'],
        ])->name('member.passport.login');
        Route::post('/token/personal/generate', [
            'uses'       => 'PassportController@personalTokenGenerate',
            'middleware' => 'api',
        ]);
    }
);
