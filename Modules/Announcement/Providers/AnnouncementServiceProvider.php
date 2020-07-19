<?php

namespace Modules\Announcement\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Announcement\Policies\ManageAnnouncementPolicy;
use Modules\Announcement\Services\ManageAnnouncementService;
use Modules\Branch\Repositories\BranchRepo;
use Modules\Files\Repositories\EditorFilesRepo;

class AnnouncementServiceProvider extends ServiceProvider
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
        \Gate::policy(ManageAnnouncementPolicy::class, ManageAnnouncementPolicy::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config' => config_path('Announcement'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/announcement');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/announcement';
        }, \Config::get('view.paths')), [$sourcePath]), 'announcement');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/announcement');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'announcement');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'announcement');
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
        $this->app->bind(ManageAnnouncementService::class, function (Application $app) {
            $storage = $app->environment(['production', 'testing']) ? \Storage::disk('s3') : \Storage::disk('public');

            return new ManageAnnouncementService(new BranchRepo(), new EditorFilesRepo(), $storage);
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
