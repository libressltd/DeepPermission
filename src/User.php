<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
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
}
