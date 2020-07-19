<?php

namespace Modules\Episode\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Modules\Episode\Constants\EpisodeMediaMorphConstants;
use Illuminate\Foundation\Application;
use Modules\Episode\Contracts\IEpisodeProvider;
use Modules\Episode\Repositories\EpisodeRepo;

class EpisodeServiceProvider extends ServiceProvider
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
        $this->registerRelation();
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
            __DIR__ . '/../Config' => config_path('Episode'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/episode');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/episode';
        }, \Config::get('view.paths')), [$sourcePath]), 'episode');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/episode');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'episode');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'episode');
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
        $this->app->bind(IEpisodeProvider::class, function (Application $app) {
            return $app->make(EpisodeRepo::class);
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

    /**
     * get the morph map for polymorphic relations.
     * @return  void
     */
    private function registerRelation()
    {
        Relation::morphMap(EpisodeMediaMorphConstants::morphMap());
    }
}
