<?php

namespace Modules\ShortFilm\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\ShortFilm\Policies\AVActressSettingPolicy;
use Modules\ShortFilm\Policies\CupSettingPolicy;
use Modules\ShortFilm\Policies\GenresSettingPolicy;
use Modules\ShortFilm\Policies\ManageShortFilmPolicy;
use Modules\ShortFilm\Policies\RegionSettingPolicy;
use Modules\ShortFilm\Policies\TopicTypePolicy;
use Modules\ShortFilm\Policies\YearsSettingPolicy;

class ShortFilmServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('ShortFilm'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/shortfilm');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/shortfilm';
        }, \Config::get('view.paths')), [$sourcePath]), 'shortfilm');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/shortfilm');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'shortfilm');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'shortfilm');
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
        \Gate::policy(YearsSettingPolicy::class, YearsSettingPolicy::class);
        \Gate::policy(RegionSettingPolicy::class, RegionSettingPolicy::class);
        \Gate::policy(CupSettingPolicy::class, CupSettingPolicy::class);
        \Gate::policy(AVActressSettingPolicy::class, AVActressSettingPolicy::class);
        \Gate::policy(GenresSettingPolicy::class, GenresSettingPolicy::class);
        \Gate::policy(TopicTypePolicy::class, TopicTypePolicy::class);
        \Gate::policy(ManageShortFilmPolicy::class, ManageShortFilmPolicy::class);
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
