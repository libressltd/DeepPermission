<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission_group extends Model
{
    public function permission()
    {
        return $this->hasMany('App\Models\Permission', "permission_group_id");
    }
}
