<?php

namespace App\Providers;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Modules\Anime\Entities\Anime;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Drama\Entities\Drama;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Files\Repositories\EditorFilesRepo;
use Modules\Movie\Entities\Movie;
use Modules\Variety\Entities\Variety;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->register();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Cloud::class, function (Application $app) {
            return $app->environment(['production', 'testing']) ? \Storage::disk('s3') : \Storage::disk('public');
        });
        $this->app->bind(IEditorFilesProvider::class, function (Application $app) {
            return new EditorFilesRepo();
        });
        Relation::morphMap([
            ClassifiedConstant::MOVIE   => Movie::class,
            ClassifiedConstant::VARIETY => Variety::class,
            ClassifiedConstant::DRAMA   => Drama::class,
            ClassifiedConstant::ANIME   => Anime::class
        ]);
    }
}
