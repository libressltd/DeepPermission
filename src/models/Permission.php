<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
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
}
