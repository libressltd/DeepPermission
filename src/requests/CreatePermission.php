<?php

namespace App\Http\Requests\DeepPermission;

use App\Http\Requests\Request;

class CreatePermission extends Request
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
		            'name' => 'required',
		        	'code' => 'required|unique:permissions,code',
		            'permission_group_id' => 'required',
		        );
				
			case 'PUT':
				return array(
		            'name' => 'required',
		        	'code' => 'required|unique:permissions,code,'.$this->permission,
		            'permission_group_id' => 'required',
		        );
			default: return array();
		}
    }
}
