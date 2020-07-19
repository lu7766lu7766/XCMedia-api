<?php

namespace Modules\Anime\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Anime\Http\Controllers\LeaderBoardController;
use Modules\Anime\Policies\GenresSettingPolicy;
use Modules\Anime\Policies\LanguageSettingPolicy;
use Modules\Anime\Policies\ManageAnimePolicy;
use Modules\Anime\Policies\RegionSettingPolicy;
use Modules\Anime\Policies\SourceSettingPolicy;
use Modules\Anime\Policies\TopicTypePolicy;
use Modules\Anime\Policies\YearsSettingPolicy;
use Modules\Anime\Repositories\AnimeRepo;
use Modules\Anime\Services\ManageAnimeService;
use Modules\Classified\Service\LeaderBoardService;
use Modules\Files\Repositories\EditorFilesRepo;

class AnimeServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config' => config_path('Anime'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/anime');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/anime';
        }, \Config::get('view.paths')), [$sourcePath]), 'anime');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/anime');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'anime');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'anime');
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
        \Gate::policy(TopicTypePolicy::class, TopicTypePolicy::class);
        \Gate::policy(ManageAnimePolicy::class, ManageAnimePolicy::class);
        $this->app->bind(ManageAnimeService::class, function (Application $app) {
            $storage = $app->environment(['production', 'testing']) ? \Storage::disk('s3') : \Storage::disk('public');

            return new ManageAnimeService($storage, new EditorFilesRepo());
        });
        $this->app->when(LeaderBoardController::class)
            ->needs(LeaderBoardService::class)->give(function (Application $app) {
                return new LeaderBoardService(app(AnimeRepo::class));
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
