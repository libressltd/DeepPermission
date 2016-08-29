<?php

namespace App\Http\Requests\DeepPermission;

use App\Http\Requests\Request;

class CreatePermissionGroup extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    	switch($this->method())
		{
			case 'POST':
		        return array(
		            'name' => 'required|unique:permission_groups,name',
		        	'code' => 'required|unique:permission_groups,code',
		        );
				
			case 'PUT':
				return array(
		            'name' => 'required|unique:permission_groups,name,'.$this->group,
		        	'code' => 'required|unique:permission_groups,code,'.$this->group,
		        );
			default: return array();
		}
    }
}
