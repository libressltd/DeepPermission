<?php

namespace LIBRESSLtd\DeepPermission\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Permission_group;

class PermissionGroupController extends Controller
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
        return view("dp::permission_group.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dp::permission_group.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = new Permission_group;
		$group->name = $request->name;
		$group->code = $request->code;
		$group->save();
		
		return redirect(url("permission_group"));
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
    	$group = Permission_group::findOrFail($id);
        return view("dp::permission_group.add", array("group" => $group));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Permission_group::findOrFail($id);
		$group->name = $request->name;
		$group->code = $request->code;
		$group->save();
		
		return redirect(url("permission_group"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$group = Permission_group::findOrFail($id);
		$group->delete();
		
		return redirect(url("permission_group"));
    }
}
