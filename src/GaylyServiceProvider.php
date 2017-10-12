<?php
// +----------------------------------------------------------------------
// | Gayly [ GOOD GOOD STUDY DAY DAY UP ]
// +----------------------------------------------------------------------
// | Copyright (c) http://smhx.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: gayly <tthd@163.com>
// +----------------------------------------------------------------------

namespace Onini\Gayly;

use Illuminate\Support\{
    ServiceProvider,
    Facades\Route
};

class GaylyServiceProvider extends ServiceProvider
{

    /**
     * route middlewares
     * @var [type]
     */
    protected $routeMiddleware = [
        'gayly.auth'    =>    \Onini\Gayly\Middleware\Authenticated::class,
        'gayly.guest'    =>    \Onini\Gayly\Middleware\Redirect::class,
        'gayly.permission'    =>    \Onini\Gayly\Middleware\Permission::class,
        'gayly.operationlog'    =>    \Onini\Gayly\Middleware\OperationLog::class,
        'gayly.bootstrap'    =>    \Onini\Gayly\Middleware\Bootstrap::class,
        'gayly.exception'    =>    \Onini\Gayly\Middleware\Exception::class,
    ];

    /**
     * middleware group
     * @var [type]
     */
    protected $middlewareGroup = [
        'gayly'    =>    [
            'gayly.auth',
            'gayly.permission',
            'gayly.operationlog',
            'gayly.bootstrap',
            'gayly.exception',
        ],
    ];

    /**
     * command
     * @var [type]
     */
    protected $command = [
        'Onini\Gayly\Console\InstallCommand',
        'Onini\Gayly\Console\UninstallCommand',
        'Onini\Gayly\Console\MenuCommand',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', config('gayly.view.namesace', 'gayly'));

        $this->registerPublishes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (file_exists(config_path('gayly.php'))) {

            $this->mergeConfig();

            $this->registerMiddleware();

            $this->registerGaylyRoute();
        }

        $this->commands($this->command);
    }

    protected function registerPublishes()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'gayly-config');
            $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang')], 'gayly-lang');
            $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/gayly')], 'gayly-assets');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'gayly-migrations');
        }
    }

    /**
     * merge config
     * @method mergeConfig
     * @return [type]      [description]
     */
    public function mergeConfig()
    {
        // set auth guard
        config(array_dot(config('gayly.auth', []), 'auth.'));
        // set database prefix
        $default = config('database.default');
        config(['database.connections.'.$default.'.prefix' => config('gayly.database.prefix')]);
    }

    protected function registerGaylyRoute()
    {
        Route::group([
            'prefix' => config('gayly.route.prefix'),
            'middleware' => 'web',
        ], function ($router) {
            /**
             * auth login
             * @var [type]
             */
            $router->group([
                'prefix'    =>  'auth',
                'namespace' => 'Onini\\Gayly\\Controllers\\Auth',
            ], function ($router) {
                $router->get('login', 'LoginController@showLoginForm');
                $router->post('login', 'LoginController@login');
                $router->get('logout', 'LoginController@logout');
            });

            /**
             * permission
             * @var [type]
             */
            $router->group([
                'middleware' => config('gayly.route.middleware', 'gayly'),
            ], function ($router) {
                $router->group([
                    'prefix'    =>  'auth',
                    'namespace' => 'Onini\\Gayly\\Controllers',
                ], function ($router) {
                    $router->resource('user', 'UserController', ['names' => config('gayly.route.name', 'gayly.').'user']);
                    $router->resource('role', 'Auth\RoleController', ['names' => config('gayly.route.name', 'gayly.').'role']);
                    $router->resource('permission', 'Auth\PermissionController', ['names' => config('gayly.route.name', 'gayly.').'permission']);
                    $router->resource('menu', 'MenuController', ['names' => config('gayly.route.name', 'gayly.').'menu', 'except' => ['create']]);
                    $router->resource('log', 'OperationLogController', ['names' => config('gayly.route.name', 'gayly.').'log', 'only' => ['index', 'destroy']]);
                });

                if (file_exists($routes = gayly_path('routes.php'))) {
                    $router
                        ->namespace(config('gayly.route.namespace'))
                        ->group($routes);
                }
            });
        });
    }

    /**
     * register middleware and group
     * @method registerMiddleware
     * @return [type]             [description]
     */
    protected function registerMiddleware()
    {
        $this->registerRouteMiddleware();
        $this->registerMiddlewareGroup();
    }

    /**
     * register middleware
     * @method registerRouteMiddleware
     * @return [type]                  [description]
     */
    protected function registerRouteMiddleware()
    {
        foreach ($this->routeMiddleware as $key => $value) {
            app('router')->aliasMiddleware($key, $value);
        }
    }

    /**
     * register middleware group
     * @method registerMiddlewareGroup
     * @return [type]                  [description]
     */
    protected function registerMiddlewareGroup()
    {
        foreach ($this->middlewareGroup as $key => $value) {
            app('router')->middlewareGroup($key, $value);
        }
    }
}
