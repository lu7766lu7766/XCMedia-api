<?php

namespace Modules\Literature\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Literature\Policies\GenresSettingPolicy;
use Modules\Literature\Policies\ManageLiteraturePolicy;
use Modules\Literature\Policies\ManageLiteratureVolumePolicy;
use Modules\Literature\Policies\RegionSettingPolicy;
use Modules\Literature\Policies\TopicTypePolicy;
use Modules\Literature\Policies\YearsSettingPolicy;

class LiteratureServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('Literature'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/literature');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/literature';
        }, \Config::get('view.paths')), [$sourcePath]), 'literature');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/literature');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'literature');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'literature');
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
        \Gate::policy(GenresSettingPolicy::class, GenresSettingPolicy::class);
        \Gate::policy(TopicTypePolicy::class, TopicTypePolicy::class);
        \Gate::policy(ManageLiteraturePolicy::class, ManageLiteraturePolicy::class);
        \Gate::policy(ManageLiteratureVolumePolicy::class, ManageLiteratureVolumePolicy::class);
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
