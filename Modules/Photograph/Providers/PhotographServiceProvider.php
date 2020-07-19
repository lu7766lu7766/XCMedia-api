<?php

namespace Modules\Photograph\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Photograph\Policies\AVActressSettingPolicy;
use Modules\Photograph\Policies\CupSettingPolicy;
use Modules\Photograph\Policies\GenresSettingPolicy;
use Modules\Photograph\Policies\PhotographPhotoPolicy;
use Modules\Photograph\Policies\PhotographyManagePolicy;
use Modules\Photograph\Policies\RegionSettingPolicy;
use Modules\Photograph\Policies\TopicTypePolicy;
use Modules\Photograph\Policies\YearsSettingPolicy;

class PhotographServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('Photograph'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/photograph');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/photograph';
        }, \Config::get('view.paths')), [$sourcePath]), 'photograph');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/photograph');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'photograph');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'photograph');
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
        \Gate::policy(PhotographyManagePolicy::class, PhotographyManagePolicy::class);
        \Gate::policy(PhotographPhotoPolicy::class, PhotographPhotoPolicy::class);
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
