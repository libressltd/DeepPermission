<?php

namespace LIBRESSLtd\DeepPermission;

use Illuminate\Support\ServiceProvider;

class DeepPermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views/role', 'role');
        $this->loadViewsFrom(__DIR__.'/views', 'dp');
		$this->publishes([
	        __DIR__.'/views' => base_path('resources/views/libressltd/deeppermission'),
	        __DIR__.'/migrations' => base_path('database/migrations'),
	        __DIR__.'/models' => base_path('app/Models'),
	    ], 'deeppermission');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('LIBRESSLtd\DeepPermission\Controllers\RoleController');
    }
}
