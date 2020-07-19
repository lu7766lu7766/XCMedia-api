<?php

namespace Modules\Passport\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Client;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\TokenRepository;
use Modules\Account\Listeners\AccountLoginRecord;
use Modules\Member\Listeners\MemberLoginRecord;
use Modules\Passport\Listeners\RevokeOldAccessToken;
use Modules\Passport\Repository\TokenManagerRepository;
use Modules\Passport\Repository\TokenShrewdRepository;

class PassportServiceProvider extends ServiceProvider
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
        $this->registerSubscribe();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        // ref : https://mlo.io/blog/2018/08/17/laravel-passport-uuid/
        // 產生時id替換成字串亂碼(原本為流水號)
        Client::creating(function (Client $client) {
            $client->incrementing = false;
            /** @noinspection PhpUndefinedFieldInspection */
            $client->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        });
        // 搜尋時取消incrementing,防止資料轉換成數字
        Client::retrieved(function (Client $client) {
            $client->incrementing = false;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config'              => config_path('Passport'),
            __DIR__ . '/../Config/passport.php' => config_path('passport.php'),
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
        $this->app->singleton(TokenManagerRepository::class);
        $this->app->singleton(TokenRepository::class, TokenShrewdRepository::class);
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
     * Register event listener.
     */
    private function registerSubscribe()
    {
        \Event::listen(AccessTokenCreated::class, RevokeOldAccessToken::class);
        \Event::listen(AccessTokenCreated::class, AccountLoginRecord::class);
        \Event::listen(AccessTokenCreated::class, MemberLoginRecord::class);
    }
}
