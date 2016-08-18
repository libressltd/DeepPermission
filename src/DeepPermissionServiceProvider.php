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
		$this->publishes([
	        __DIR__.'/views' => base_path('resources/views/libressltd/deeppermission'),
	    ]);
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
