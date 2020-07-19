<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/5
 * Time: 下午 05:31
 */
Route::group(
    [
        'middleware' => 'client_api',
        'prefix'     => 'client/member/favorite',
        'namespace'  => 'Modules\Member\Http\Controllers'
    ],
    function () {
        Route::get('/', 'MyFavoriteController@index');
        Route::get('/total', 'MyFavoriteController@total');
        Route::delete('/', 'MyFavoriteController@remove');
        Route::delete('/remove_all', 'MyFavoriteController@removeAll');
        Route::get('/is_my_favorite', 'MyFavoriteController@isMyFavorite');
    }
);
