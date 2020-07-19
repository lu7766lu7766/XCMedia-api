<?php

namespace Modules\Member\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Modules\Branch\Contracts\IBranchProvider;
use Modules\Branch\Repositories\BranchRepo;
use Modules\Member\Constants\MemberViewedMorphConstants;
use Modules\Member\Policies\ManageMemberPolicy;
use Modules\Member\Services\ManageMemberService;

class MemberServiceProvider extends ServiceProvider
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
        $this->registerRelation();
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
            __DIR__ . '/../Config' => config_path('Member'),
        ], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/member');
        $sourcePath = __DIR__ . '/../Resources/views';
        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/member';
        }, \Config::get('view.paths')), [$sourcePath]), 'member');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/member');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'member');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'member');
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
        $this->app->bind(ManageMemberService::class, function (Application $app) {
            return new ManageMemberService(new BranchRepo());
        });
        $this->app->bind(IBranchProvider::class, function (Application $app) {
            return $app->make(BranchRepo::class);
        });
        \Gate::policy(ManageMemberPolicy::class, ManageMemberPolicy::class);
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

    /**
     *
     */
    private function registerRelation()
    {
        Relation::morphMap(MemberViewedMorphConstants::morphMap());;
    }
}
