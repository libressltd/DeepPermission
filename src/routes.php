<?php

Route::group(['middleware' => 'web'], function () {
	Route::resource("role", "libressltd\deeppermission\controllers\RoleController");
	Route::resource("role.permission", "libressltd\deeppermission\controllers\RolePermissionController");
	Route::resource("permission_group", "libressltd\deeppermission\controllers\PermissionGroupController");
	Route::resource("permission", "libressltd\deeppermission\controllers\PermissionController");
	Route::resource("user_role", "libressltd\deeppermission\controllers\UserRoleController");
	Route::resource("user.permission", "libressltd\deeppermission\controllers\UserPermissionController");
});
