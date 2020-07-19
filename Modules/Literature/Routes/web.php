<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'literature', 'namespace' => 'Modules\Literature\Http\Controllers'], function () {
    Route::get('/', 'LiteratureController@simple');
});
