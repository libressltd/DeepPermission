# DeepPermission

### Step 1: Install DeepPermission

composer require libressltd/deeppermission

### Step 2: Add service provider to config/app.php

LIBRESSLtd\DeepPermission\DeepPermissionServiceProvider::class, 
LIBRESSLtd\LBForm\LBFormServiceProvider::class,

### Step 3: Publish vendor

php artisan vendor:publish --tag=deeppermission --force

### Step 4: Add following line to User Model (Remember to move User.php to app/Models) or you can find the newest version in vendor/libresslt/deeppermission/src/User.php
	
```php
/**
 * Addition function for DeepPermission
 * 
 */
 
public $__permissions = NULL;
public $__roles = NULL; 

public function roles()
{
    return $this->belongsToMany('App\Models\Role', "user_roles", "role_id", "user_id");
}

public function permissions()
{
    return $this->belongsToMany('App\Models\Permission', "user_permissions", "permission_id", "user_id");
}

public function loadAllPermissionAndRole()
{
	if ($this->__roles == NULL)
	{
		$this->__roles = $this->roles()->with("permissions")->get();
	}
	
	if ($this->__permissions == NULL);
	{
		$this->__permissions = array();
		foreach ($this->permissions as $permission)
		{
			$this->__permissions[] = $permission;
		}
		foreach ($this->__roles as $role)
		{
			foreach ($role->permissions as $permission)
			{
				$found = FALSE;
				foreach ($this->__permissions as $p)
				{
					if ($p->id == $permission->id)
					{
						$found = TRUE;
						break;
					}
				}
				if (!$found)
				{
					$this->__permissions[] = $permission;
				}
			}
		}
	}
}

public function allPermission()
{
	$this->loadAllPermissionAndRole();
	return $this->__permissions;
}

public function hasRole($role_code)
{
	$this->loadAllPermissionAndRole();
	foreach ($this->__roles as $role)
	{
		if ($role_code === $role->code)
		{
			return TRUE;
		}
	}
	return FALSE;
}

public function hasPermission($permission_code)
{
	$this->loadAllPermissionAndRole();
	foreach ($this->__permissions as $permission)
	{
		if ($permission_code === $permission->code)
		{
			return TRUE;
		}
	}
	return FALSE;
}

/**
 * End of additional function
 * 
 */
```