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
	 
	public $__localPermissions = NULL;
	public $__localRoles = NULL; 
	
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
		if ($this->__localRoles == NULL)
		{
			$this->__localRoles = $this->roles()->with("permissions")->get();
		}
		
		if ($this->__localPermission == NULL);
		{
			$this->__localPermission = array();
			foreach ($this->permissions as $permission)
			{
				$this->__localPermission[] = $permission;
			}
			foreach ($this->__localRoles as $role)
			{
				foreach ($role->permissions as $permission)
				{
					$found = FALSE;
					foreach ($this->__localPermission as $p)
					{
						if ($p->id == $permission->id)
						{
							$found = TRUE;
							break;
						}
					}
					if (!$found)
					{
						$this->__localPermission[] = $permission;
					}
				}
			}
		}
	}
	
	public function allPermission()
	{
		$this->loadAllPermissionAndRole();
		return $this->__localPermission;
	}
	
	public function hasRole($role_code)
	{
		if (Auth::user()->id == env("LIBRE_DP_ADMIN_ID", -1))
		{
			return TRUE;
		}
		$this->loadAllPermissionAndRole();
		foreach ($this->__localRoles as $role)
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
		if (Auth::user()->id == env("LIBRE_DP_ADMIN_ID", -1))
		{
			return TRUE;
		}
		$this->loadAllPermissionAndRole();
		foreach ($this->__localPermission as $permission)
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

### Step 5 (optional): If you want a user pass all the permission, add LIBRE_DP_ADMIN_ID to your .env file

```bash
LIBRE_DP_ADMIN_ID={{user_id}}
#for example
LIBRE_DP_ADMIN_ID=1

```
