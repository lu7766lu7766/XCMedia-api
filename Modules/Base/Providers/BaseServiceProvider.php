<?php

namespace Modules\Base\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use XC\Independent\Kit\Utils\UrlParserUtil;

class BaseServiceProvider extends ServiceProvider
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
            __DIR__ . '/../Config'             => config_path('Base'),
            __DIR__ . '/../Config/modules.php' => config_path('modules.php'),
            __DIR__ . '/../Config/cors.php'    => config_path('cors.php'),
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
        $this->app->singleton(UrlParserUtil::class, function (Application $app) {
            $request = $app->make(Request::class);

            return new UrlParserUtil($request->header('Referer', ''));
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
