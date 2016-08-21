<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', "role_permissions", "permission_id", "role_id");
    }
	
    public function users()
    {
        return $this->belongsToMany('App\Models\User', "user_roles", "user_id", "role_id");
    }
}
