<?php

namespace LIBRESSLtd\DeepPermission\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Models\Permission_group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Role_permission;
use Excel;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dp::setting.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function getInitial()
    {
        Permission_group::addIfNotExist("Permission", "permission");
        Permission_group::addIfNotExist("Permission Group", "permission_group");
        Permission_group::addIfNotExist("Role", "role");
        Permission_group::addIfNotExist("User Role", "user_role");
        
        Permission::addIfNotExist("Add", "permission.add");
        Permission::addIfNotExist("Edit", "permission.edit");
        Permission::addIfNotExist("Delete", "permission.delete");
        Permission::addIfNotExist("View", "permission.view");
        
        Permission::addIfNotExist("Add", "permission_group.add");
        Permission::addIfNotExist("Edit", "permission_group.edit");
        Permission::addIfNotExist("Delete", "permission_group.delete");
        Permission::addIfNotExist("View", "permission_group.view");
        
        Permission::addIfNotExist("Add", "role.add");
        Permission::addIfNotExist("Edit", "role.edit");
        Permission::addIfNotExist("Delete", "role.delete");
        Permission::addIfNotExist("View", "role.view");
        
        Permission::addIfNotExist("View", "user_role.view");
        Permission::addIfNotExist("Setting", "permission.setting");
        
        return redirect(url("permission/setting"))->with('dp_announce', 'Database initial success');
    }
    
    function getExport()
    {
        Excel::create('DeepPermissionExport', function($excel) {
            $excel->sheet('Permission_group', function($sheet) {
                $sheet->fromModel(Permission_group::get(), null, "A1", false, false);
            });
            $excel->sheet('Permission', function($sheet) {
                $sheet->fromModel(Permission::get(), null, "A1", false, false);
            });
            $excel->sheet('Role', function($sheet) {
                $sheet->fromModel(Role::get(), null, "A1", false, false);
            });
            $excel->sheet('Role_permission', function($sheet) {
                $sheet->fromModel(Role_permission::get(), null, "A1", false, false);
            });
        })->export('xls');
    }

    function postImport($request)
    {
        $file = Input::file('import');
        $filename = $this->doSomethingLikeUpload($file);

        return Excel::load($filename, function($reader) {

        })->get();
    }
}
