<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', "permission_id", "role_id", "role_permissions");
    }
	
    public function users()
    {
        return $this->belongsToMany('App\Models\User', "user_id", "role_id", "user_roles");
    }
}
