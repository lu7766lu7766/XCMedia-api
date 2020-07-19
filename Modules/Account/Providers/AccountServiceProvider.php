<?php

namespace Modules\Account\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Account\Access\NodeAccessor;
use Modules\Account\Policies\AccountPolicy;
use Modules\Account\Service\AccountService;
use Modules\Account\Service\AdminAccountService;
use Modules\Account\Service\LoginHistoryService;
use Modules\Account\Service\ManageAccountService;
use Modules\Node\Contract\IGate;
use Modules\Role\Contract\IRoleProvider;
use Modules\Role\Repository\AdminRoleRepo;
use Modules\Role\Repository\PublicRoleRepo;

class AccountServiceProvider extends ServiceProvider
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
        \Gate::policy(AccountPolicy::class, AccountPolicy::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config' => config_path('Account'),
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
        $this->app->when(ManageAccountService::class)->needs(IRoleProvider::class)->give(PublicRoleRepo::class);
        $this->app->when(AdminAccountService::class)->needs(IRoleProvider::class)->give(AdminRoleRepo::class);
        $this->app->when(LoginHistoryService::class)->needs(IRoleProvider::class)->give(PublicRoleRepo::class);
        $this->app->singleton(IGate::class, function () {
            return new NodeAccessor($this->app->make('auth')->guard()->user());
        });
        $this->app->bind(AccountService::class, function (Application $app) {
            $storage = $app->environment(['production', 'testing']) ? \Storage::disk('s3') : \Storage::disk('public');

            return new AccountService($this->app->make('auth')->guard()->user(), $storage);
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
