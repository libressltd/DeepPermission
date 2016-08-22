# DeepPermission

### Step 1: Install DeepPermission

composer require libressltd/deeppermission

### Step 2: Add service provider to config/app.php

LIBRESSLtd\DeepPermission\DeepPermissionServiceProvider::class, 
LIBRESSLtd\LBForm\LBFormServiceProvider::class,

### Step 3: Publish vendor

php artisan vendor:publish --tag=deeppermission --force

### Step 4: Add following line to User Model (Remember to move User.php to app/Models)
	
public function roles()
{
    return $this->belongsToMany('App\Models\Role', "user_roles", "user_id", "role_id");
}

public function permissions()
{
    return $this->belongsToMany('App\Models\Permission', "user_permissions", "user_id", "permission_id");
}