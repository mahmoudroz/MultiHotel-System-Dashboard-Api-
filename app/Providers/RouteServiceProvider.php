<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $namespaceSupervisor = 'App\Http\Controllers\Api\Supervisor';
    protected $namespaceEmployee = 'App\Http\Controllers\Api\Employee';
    protected $namespaceGuest = 'App\Http\Controllers\Api\Guest';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/dashboard/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapSupervisorRoutes();
        $this->mapEmployeeRoutes();
        $this->mapGuestRoutes();
        $this->mapWebRoutes();

        //
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
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapGuestRoutes()
    {
        Route::prefix('guest')
            ->middleware('api')
            ->namespace($this->namespaceGuest)
            ->group(base_path('routes/guest.php'));
    }
    protected function mapSupervisorRoutes()
    {
        Route::prefix('supervisor')
            ->middleware('api')
            ->namespace($this->namespaceSupervisor)
            ->group(base_path('routes/supervisor.php'));
    }
    protected function mapEmployeeRoutes()
    {
        Route::prefix('employee')
            ->middleware('api')
            ->namespace($this->namespaceEmployee)
            ->group(base_path('routes/employee.php'));
    }
}
