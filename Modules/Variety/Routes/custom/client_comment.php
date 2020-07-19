<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/10
 * Time: 下午 06:42
 */
Route::group(
    [
        'middleware' => 'client_api',
        'prefix'     => 'variety/comment',
        'namespace'  => 'Modules\Variety\Http\Controllers'
    ],
    function () {
        Route::post('/', 'CommentController@add');
    }
);
