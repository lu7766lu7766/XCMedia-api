<?php

namespace Modules\Comic\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Modules\Comic\Policies\GenresSettingPolicy;
use Modules\Comic\Policies\ManageComicPolicy;
use Modules\Comic\Policies\RegionSettingPolicy;
use Modules\Comic\Policies\TopicTypePolicy;
use Modules\Comic\Policies\YearsSettingPolicy;
use Modules\Comic\Services\ManageComicService;
use Modules\Files\Repositories\EditorFilesRepo;

class ComicServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('Comic'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/comic');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/comic';
        }, \Config::get('view.paths')), [$sourcePath]), 'comic');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/comic');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'comic');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'comic');
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
        \Gate::policy(ManageComicPolicy::class, ManageComicPolicy::class);
        $this->app->bind(ManageComicService::class, function (Application $app) {
            return new ManageComicService(new EditorFilesRepo());
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
