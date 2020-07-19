<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 06:49
 */

use Modules\Video\Policies\AdultVideoBucketPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'manage/adult_video/bucket',
    'namespace'  => 'Modules\Video\Http\Controllers'
], function () {
    Route::get('/', 'AdultVideoBucketController@info')->middleware('can:read,' . AdultVideoBucketPolicy::class);
    Route::post('/', 'AdultVideoBucketController@store')->middleware('can:create,' . AdultVideoBucketPolicy::class);
    Route::post('/update', 'AdultVideoBucketController@update')
        ->middleware('can:update,' . AdultVideoBucketPolicy::class);
});
