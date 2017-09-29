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

use Illuminate\Support\ServiceProvider;

class GaylyServiceProvider extends ServiceProvider
{

	/**
	 * route middlewares
	 * @var [type]
	 */
	protected $routeMiddleware = [
		'gayly.auth'	=>	\Onini\Gayly\Middleware\Authenticated::class,
		'gayly.guest'	=>	\Onini\Gayly\Middleware\Redirect::class,
		'gayly.permission'	=>	\Onini\Gayly\Middleware\Permission::class,
		'gayly.operationlog'	=>	\Onini\Gayly\Middleware\OperationLog::class,
	];

	/**
	 * middleware group
	 * @var [type]
	 */
	protected $middlewareGroup = [
		'gayly'	=>	[
			'gayly.auth',
			'gayly.permission',
			'gayly.operationlog',
		],
	];

	/**
	 * command
	 * @var [type]
	 */
	protected $command = [
		'Onini\Gayly\Console\InstallCommand',
	];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->loadViewsFrom(__DIR__.'/../resource/views', config('admin.view.namesace', 'admin'));

		$this->registerPublishes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();

		$this->registerMiddleware();

		$this->commands($this->command);
    }

	protected function registerPublishes()
	{
		if ($this->app->runningInConsole()) {
			$this->publishes([__DIR__.'/../config' => config_path()], 'gayly-config');
			$this->publishes([__DIR__.'/../resources/lang' => resource_path('lang')], 'gayly-lang');
			$this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/gayly')], 'gayly-assets');
			$this->publishes([__DIR__.'/database/migrations' => database_path('migrations')], 'gayly-migrations');
		}
	}

	/**
	 * merge config
	 * @method mergeConfig
	 * @return [type]      [description]
	 */
	protected function mergeConfig()
	{
		if (file_exists(config_path('admin'))) {
			// set auth guard
			config(array_dot(config('admin.auth', []), 'auth.'));
			// set database prefix
			$default = config('database.default');
			config(['database.connections.'.$default.'.prefix' => config('admin.database.prefix')]);
		}
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
