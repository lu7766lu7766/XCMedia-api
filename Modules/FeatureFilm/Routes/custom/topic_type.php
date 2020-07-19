<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/7
 * Time: 下午 04:41
 */

use Modules\FeatureFilm\Policies\TopicTypePolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'feature_film/topic/type',
    'namespace'  => 'Modules\FeatureFilm\Http\Controllers'
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
