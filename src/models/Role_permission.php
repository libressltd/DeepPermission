<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_permission extends Model
{
    public function role()
    {
        return $this->belongsTo('App\Models\Role', "role_id");
    }

    public function permission()
    {
        return $this->belongsTo('App\Models\Permission', "permission_id");
    }
}
