<?php

namespace Modules\Video\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Video\Policies\AdultVideoBucketPolicy;
use Modules\Video\Policies\AdultVideoPolicy;
use Modules\Video\Policies\AVActressSettingPolicy;
use Modules\Video\Policies\CupSettingPolicy;
use Modules\Video\Policies\GenresSettingPolicy;
use Modules\Video\Policies\RegionSettingPolicy;
use Modules\Video\Policies\TopicTypePolicy;
use Modules\Video\Policies\YearsSettingPolicy;

class VideoServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('Video'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/video');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/video';
        }, \Config::get('view.paths')), [$sourcePath]), 'video');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/video');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'video');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'video');
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
        \Gate::policy(AdultVideoPolicy::class, AdultVideoPolicy::class);
        \Gate::policy(AdultVideoBucketPolicy::class, AdultVideoBucketPolicy::class);
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
