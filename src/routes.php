<?php

Route::group(['middleware' => 'web'], function () {
	Route::resource("role", "libressltd\deeppermission\controllers\RoleController");
});
