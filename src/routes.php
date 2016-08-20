<?php

Route::group(['middleware' => 'web'], function () {
	Route::resource("role", "libressltd\deeppermission\controllers\RoleController");
	Route::resource("permission_group", "libressltd\deeppermission\controllers\PermissionGroupController");
	Route::resource("permission", "libressltd\deeppermission\controllers\PermissionController");
});
