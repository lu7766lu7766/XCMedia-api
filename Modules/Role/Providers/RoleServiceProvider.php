<?php

namespace Modules\Role\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Node\Contract\INodeProvider;
use Modules\Node\Repository\PublicNodeRepo;
use Modules\Role\Http\Controllers\PublicRoleController;
use Modules\Role\Policies\PublicRolePolicy;
use Modules\Role\Service\PublicRoleService;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
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
        \Gate::policy(PublicRolePolicy::class, PublicRolePolicy::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config' => config_path('Role'),
        ], 'config');
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
        $this->app->when([PublicRoleService::class, PublicRoleController::class])
            ->needs(INodeProvider::class)
            ->give(PublicNodeRepo::class);
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
