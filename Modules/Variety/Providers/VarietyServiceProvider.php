<?php

namespace Modules\Variety\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Classified\Service\LeaderBoardService;
use Modules\Files\Repositories\EditorFilesRepo;
use Modules\Variety\Http\Controllers\LeaderBoardController;
use Modules\Variety\Policies\GenresSettingPolicy;
use Modules\Variety\Policies\LanguageSettingPolicy;
use Modules\Variety\Policies\ManageVarietyPolicy;
use Modules\Variety\Policies\RegionSettingPolicy;
use Modules\Variety\Policies\SourceSettingPolicy;
use Modules\Variety\Policies\TopicTypePolicy;
use Modules\Variety\Policies\YearsSettingPolicy;
use Modules\Variety\Repositories\VarietyRepo;
use Modules\Variety\Services\ManageVarietyService;

class VarietyServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('Variety'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/variety');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/variety';
        }, \Config::get('view.paths')), [$sourcePath]), 'variety');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/variety');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'variety');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'variety');
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
        $this->app->bind(ManageVarietyService::class, function (Application $app) {
            $storage = $app->environment(['production', 'testing']) ? \Storage::disk('s3') : \Storage::disk('public');

            return new ManageVarietyService($storage, new EditorFilesRepo());
        });
        \Gate::policy(ManageVarietyPolicy::class, ManageVarietyPolicy::class);
        \Gate::policy(TopicTypePolicy::class, TopicTypePolicy::class);
        $this->app->when(LeaderBoardController::class)->needs(LeaderBoardService::class)
            ->give(function (Application $app) {
                return new LeaderBoardService(app(VarietyRepo::class));
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
