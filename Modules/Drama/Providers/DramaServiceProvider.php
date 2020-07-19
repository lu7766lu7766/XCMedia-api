<?php

namespace Modules\Drama\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Drama\Policies\GenresSettingPolicy;
use Modules\Drama\Policies\LanguageSettingPolicy;
use Modules\Drama\Policies\ManageDramaPolicy;
use Modules\Drama\Policies\RegionSettingPolicy;
use Modules\Drama\Policies\SourceSettingPolicy;
use Modules\Drama\Policies\TopicTypePolicy;
use Modules\Drama\Policies\YearsSettingPolicy;
use Modules\Drama\Services\ManageDramaService;
use Modules\Files\Repositories\EditorFilesRepo;

class DramaServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('Drama'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/drama');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/drama';
        }, \Config::get('view.paths')), [$sourcePath]), 'drama');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/drama');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'drama');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'drama');
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
        \Gate::policy(ManageDramaPolicy::class, ManageDramaPolicy::class);
        \Gate::policy(TopicTypePolicy::class, TopicTypePolicy::class);
        $this->app->bind(ManageDramaService::class, function (Application $app) {
            $storage = $app->environment(['production', 'testing']) ? \Storage::disk('s3') : \Storage::disk('public');

            return new ManageDramaService($storage, new EditorFilesRepo());
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
