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
		if (Auth::user()->id == env("LIBRE_DP_ADMIN_ID", -1))
		{
			return TRUE;
		}
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
		if (Auth::user()->id == env("LIBRE_DP_ADMIN_ID", -1))
		{
			return TRUE;
		}
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
}
