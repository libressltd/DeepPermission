<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission_group extends Model
{
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission', "permission_group_id");
    }
	
	static public function all_to_option()
	{
		$objects = Permission_group::all();
		$array = array();
		foreach ($objects as $object)
		{
			$array[] = array(
				"name" => $object->name,
				"value" => $object->id
			);
		}
		
		return $array;
	}
}
