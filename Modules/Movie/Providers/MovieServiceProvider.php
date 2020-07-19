<?php

namespace Modules\Movie\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Modules\Files\Repositories\EditorFilesRepo;
use Modules\Movie\Policies\GenresSettingPolicy;
use Modules\Movie\Policies\LanguageSettingPolicy;
use Modules\Movie\Policies\ManageMoviePolicy;
use Modules\Movie\Policies\RegionSettingPolicy;
use Modules\Movie\Policies\SourceSettingPolicy;
use Modules\Movie\Policies\TopicTypePolicy;
use Modules\Movie\Policies\YearsSettingPolicy;
use Modules\Movie\Services\ManageMovieService;

class MovieServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config' => config_path('Movie'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/movie');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/movie';
        }, \Config::get('view.paths')), [$sourcePath]), 'movie');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/movie');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'movie');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'movie');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
        \Gate::policy(SourceSettingPolicy::class, SourceSettingPolicy::class);
        \Gate::policy(RegionSettingPolicy::class, RegionSettingPolicy::class);
        \Gate::policy(YearsSettingPolicy::class, YearsSettingPolicy::class);
        \Gate::policy(GenresSettingPolicy::class, GenresSettingPolicy::class);
        \Gate::policy(LanguageSettingPolicy::class, LanguageSettingPolicy::class);
        \Gate::policy(TopicTypePolicy::class, TopicTypePolicy::class);
        \Gate::policy(ManageMoviePolicy::class, ManageMoviePolicy::class);
        $this->app->bind(ManageMovieService::class, function (Application $app) {
            return new ManageMovieService(new EditorFilesRepo());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
