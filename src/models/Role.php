<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', "role_permissions", "role_id", "permission_id");
    }
	
    public function users()
    {
        return $this->belongsToMany('App\Models\User', "user_roles", "role_id", "user_id");
    }
}
