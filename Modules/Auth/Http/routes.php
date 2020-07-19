<?php
Route::group(['middleware' => 'web', 'prefix' => 'auth', 'namespace' => 'Modules\Auth\Http\Controllers'], function () {
    Route::get('/login', 'AuthController@showLoginForm');
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
});
