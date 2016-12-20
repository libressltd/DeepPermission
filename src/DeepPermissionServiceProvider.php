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
	        __DIR__.'/requests' => base_path('app/Http/Requests/DeepPermission'),
            __DIR__.'/config' => base_path('app/Http/Middleware'),
            __DIR__.'/middlewares' => base_path('config'),
            __DIR__.'/lang/en/deeppermission.php' => base_path('resources/lang/en/deeppermission.php'),
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
        $this->app->make('LIBRESSLtd\DeepPermission\Controllers\PermissionGroupController');
        $this->app->make('LIBRESSLtd\DeepPermission\Controllers\PermissionController');
        $this->app->make('LIBRESSLtd\DeepPermission\Controllers\UserRoleController');
        $this->app->make('LIBRESSLtd\DeepPermission\Controllers\RolePermissionController');
        $this->app->make('LIBRESSLtd\DeepPermission\Controllers\UserPermissionController');
        $this->app->make('LIBRESSLtd\DeepPermission\Controllers\SettingController');
        // $this->app->make('LIBRESSLtd\DeepPermission\Traits\DPUserModelTrait');
    }
}
