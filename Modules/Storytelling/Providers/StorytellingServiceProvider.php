<?php

namespace Modules\Storytelling\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Files\Repositories\EditorFilesRepo;
use Modules\Storytelling\Policies\GenresSettingPolicy;
use Modules\Storytelling\Policies\ManageStorytellingAudioPolicy;
use Modules\Storytelling\Policies\ManageStorytellingPolicy;
use Modules\Storytelling\Policies\RegionSettingPolicy;
use Modules\Storytelling\Policies\TopicTypePolicy;
use Modules\Storytelling\Policies\YearsSettingPolicy;
use Modules\Storytelling\Services\ManageStorytellingService;

class StorytellingServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('Storytelling'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/storytelling');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/storytelling';
        }, \Config::get('view.paths')), [$sourcePath]), 'storytelling');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/storytelling');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'storytelling');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'storytelling');
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
        \Gate::policy(ManageStorytellingPolicy::class, ManageStorytellingPolicy::class);
        \Gate::policy(ManageStorytellingAudioPolicy::class, ManageStorytellingAudioPolicy::class);
        $this->app->bind(ManageStorytellingService::class, function (Application $app) {
            return new ManageStorytellingService(new EditorFilesRepo());
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
