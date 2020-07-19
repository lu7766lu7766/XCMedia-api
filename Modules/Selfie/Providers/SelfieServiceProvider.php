<?php

namespace Modules\Selfie\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Selfie\Policies\CupSettingPolicy;
use Modules\Selfie\Policies\GenresSettingPolicy;
use Modules\Selfie\Policies\RegionSettingPolicy;
use Modules\Selfie\Policies\SelfieSchedulePolicy;
use Modules\Selfie\Policies\SelfieVideoPolicy;
use Modules\Selfie\Policies\TopicTypePolicy;
use Modules\Selfie\Policies\YearsSettingPolicy;

class SelfieServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('Selfie'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/selfie');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/selfie';
        }, \Config::get('view.paths')), [$sourcePath]), 'selfie');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/selfie');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'selfie');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'selfie');
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
        \Gate::policy(GenresSettingPolicy::class, GenresSettingPolicy::class);
        \Gate::policy(TopicTypePolicy::class, TopicTypePolicy::class);
        \Gate::policy(SelfieSchedulePolicy::class, SelfieSchedulePolicy::class);
        \Gate::policy(SelfieVideoPolicy::class, SelfieVideoPolicy::class);
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
