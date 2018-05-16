<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $this->mapWebRoutes($router);

        $this->mapApiRoutes($router);
    }

    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'middleware' => 'web', 'namespace' => $this->namespace
        ], function ($router) {
            require app_path('Http/routes/web.routes.php');
        });
    }

    protected function mapApiRoutes(Router $router)
    {
        $router->group([
            'middleware' => 'api', 'namespace' => $this->namespace . '\Api'
        ], function ($router) {
            require app_path('Http/routes/api.routes.php');
        });
    }

    protected function mapAdminRoutes(Router $router)
    {
        $router->group([
            'middleware' => 'admi', 'namespace' => $this->namespace . '\Admin'
        ], function ($router) {
            require app_path('Htpp/routes/admin.routes.php');
        });
    }
}
