<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/10
 * Time: 上午 11:42
 */

use Modules\ShortFilm\Policies\TopicTypePolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'short_film/topic/type',
    'namespace'  => 'Modules\ShortFilm\Http\Controllers'
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
