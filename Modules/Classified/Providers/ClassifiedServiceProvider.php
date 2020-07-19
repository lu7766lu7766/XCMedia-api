<?php

namespace Modules\Classified\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Modules\Classified\Console\GetMedia;
use Modules\Classified\Contracts\IActressProvider;
use Modules\Classified\Contracts\ICupProvider;
use Modules\Classified\Contracts\IGenresProvider;
use Modules\Classified\Contracts\ILanguageProvider;
use Modules\Classified\Contracts\IRegionProvider;
use Modules\Classified\Contracts\IYearsProvider;
use Modules\Classified\Repositories\AVActressRepo;
use Modules\Classified\Repositories\CupRepo;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\LanguageSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\YearsSettingRepo;

class ClassifiedServiceProvider extends ServiceProvider
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
        $this->commands(GetMedia::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config' => config_path('Classified'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/classified');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/classified';
        }, \Config::get('view.paths')), [$sourcePath]), 'classified');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/classified');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'classified');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'classified');
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
        $this->app->bind(IActressProvider::class, function (Application $app) {
            return $app->make(AVActressRepo::class);
        });
        $this->app->bind(ICupProvider::class, function (Application $app) {
            return $app->make(CupRepo::class);
        });
        $this->app->bind(IGenresProvider::class, function (Application $app) {
            return $app->make(GenresSettingRepo::class);
        });
        $this->app->bind(IRegionProvider::class, function (Application $app) {
            return $app->make(RegionRepo::class);
        });
        $this->app->bind(IYearsProvider::class, function (Application $app) {
            return $app->make(YearsSettingRepo::class);
        });
        $this->app->bind(ILanguageProvider::class, function (Application $app) {
            return $app->make(LanguageSettingRepo::class);
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
