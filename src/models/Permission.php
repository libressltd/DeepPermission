<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission_group;

class Permission extends Model
{
	protected $fillable = array('code');
	
    public function group()
    {
        return $this->belongsTo('App\Models\Permission_group', "permission_group_id");
    }
	
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', "role_id", "permission_id", "role_permissions");
    }
	
    public function users()
    {
        return $this->belongsToMany('App\Models\User', "user_id", "permission_id", "user_permission");
    }
	
	static public function addIfNotExist($permission_name, $permission_code)
	{
		$permission_component = explode(".", $permission_code);
		$group_code = $permission_component[0];
		
		$group = Permission_group::where("code", $group_code)->first();
		if ($group)
		{
			$permission = Permission::firstOrNew(array("code" => $permission_code));
			$permission->name = $permission_name;
			$permission->permission_group_id = $group->id;
			$permission->save();
		}
	}
}
