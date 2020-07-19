<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/11
 * Time: 上午 09:52
 */

use Modules\Comic\Policies\TopicTypePolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'comic/topic/type',
    'namespace'  => 'Modules\Comic\Http\Controllers'
], function () {
    Route::get('/', 'TopicTypeController@index')
        ->middleware('can:read,' . TopicTypePolicy::class);
    Route::get('/total', 'TopicTypeController@total')
        ->middleware('can:read,' . TopicTypePolicy::class);
    Route::post('/', 'TopicTypeController@store')
        ->middleware('can:create,' . TopicTypePolicy::class);
    Route::get('/edit', 'TopicTypeController@edit')
        ->middleware('can:update,' . TopicTypePolicy::class);
    Route::post('/update', 'TopicTypeController@update')
        ->middleware('can:update,' . TopicTypePolicy::class);
    Route::delete('/', 'TopicTypeController@delete')
        ->middleware('can:delete,' . TopicTypePolicy::class);
});

