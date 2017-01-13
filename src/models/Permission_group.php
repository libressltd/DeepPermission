<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\Uuid32ModelTrait;
use Auth;

class Permission_group extends Model
{
    use Uuid32ModelTrait;

	protected $fillable = array('code');
	
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
	
	static public function addIfNotExist($group_name, $group_code)
	{
		$group = Permission_group::firstOrNew(array("code" => $group_code));
		$group->name = $group_name;
		$group->save();
		return $group;
	}

    static public function boot()
    {
    	Permission_group::bootUuid32ModelTrait();
        Permission_group::saving(function ($group) {
        	if (Auth::user())
        	{
	            if ($group->id)
	            {
	            	$group->updated_by = Auth::user()->id;
	            }
	            else
	            {
					$group->created_by = Auth::user()->id;
	            }
	        }
        });
    }
}
