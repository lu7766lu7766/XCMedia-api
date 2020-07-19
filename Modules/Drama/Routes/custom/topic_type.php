<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/6
 * Time: 下午 02:14
 */

use Modules\Drama\Policies\TopicTypePolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'drama/topic/type',
    'namespace'  => 'Modules\Drama\Http\Controllers'
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
