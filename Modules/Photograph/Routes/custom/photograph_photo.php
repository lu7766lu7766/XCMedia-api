<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 06:57
 */

use Modules\Photograph\Policies\PhotographPhotoPolicy;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'manage/photograph/photo',
    'namespace'  => 'Modules\Photograph\Http\Controllers'
], function () {
    Route::get('/', 'PhotographyPhotoManageController@index')
        ->middleware('can:read,' . PhotographPhotoPolicy::class);
    Route::post('/', 'PhotographyPhotoManageController@upload')
        ->middleware('can:create,' . PhotographPhotoPolicy::class);
    Route::delete('/', 'PhotographyPhotoManageController@delete')
        ->middleware('can:delete,' . PhotographPhotoPolicy::class);
});
