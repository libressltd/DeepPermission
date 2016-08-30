<?php

namespace LIBRESSLtd\DeepPermission\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Role;
use App\Http\Requests\DeepPermission\CreateRole;

class RoleController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dp::role.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dp::role.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRole $request)
    {
    	 $this->validate($request, array(
	        'name' => 'required|unique:roles',
	        'code' => 'required|unique:roles',
	    ));
        $role = new Role;
		$role->name = $request->name;
		$role->code = $request->code;
		$role->save();
		
		return redirect(url("role"))->with('dp_announce', 'Role created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$role = Role::findOrFail($id);
        return view("dp::role.add", array("role" => $role));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRole $request, $id)
    {
        $role = Role::findOrFail($id);
		$role->name = $request->name;
		$role->code = $request->code;
		$role->save();
		
		return redirect(url("role"))->with('dp_announce', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$role = Role::findOrFail($id);
		$role->delete();
		
		return redirect(url("role"))->with('dp_announce', 'Role deleted');
    }
}
