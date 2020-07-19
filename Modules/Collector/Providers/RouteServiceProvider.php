<?php

namespace Modules\Collector\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Collector\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapCustomRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $file = \Module::getModulePath('Collector') . '/Routes/web.php';
        if (file_exists($file)) {
            \Route::middleware('web')
                ->group($file);
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $file = \Module::getModulePath('Collector') . '/Routes/api.php';
        if (file_exists($file)) {
            \Route::prefix('api')
                ->middleware('api')
                ->group($file);
        }
    }

    /**
     * Define the custom routes without extra middleware(only system middleware)
     * These routes are typically stateless.
     * @return void
     */
    protected function mapCustomRoutes()
    {
        $folder = \Module::getModulePath('Collector') . '/Routes/custom';
        if (\File::exists($folder)) {
            foreach (\File::files($folder) as $file) {
                \Route::as('collector_')->group($file);
            }
        }
    }
}
