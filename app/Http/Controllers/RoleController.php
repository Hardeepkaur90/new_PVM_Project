<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Icon;
use App\Models\Role;
class RoleController extends Controller
{
    //
    public function list_roles()
    {
        $role = Role::join('icons','icons.id','=','role_icons')->get([
            'roles.id as role_id',
            'icons.id as icon_id',
            'role_name',
            'role_icons',
            'icon_image',
        ]);
        return view('Admin.Role.role_list',compact('role'));
    }

    public function add_roles()
    {
        $icons = Icon::all();
        return view('Admin.Role.create_role',compact('icons'));
    }
    public function add_roles_post(Request $request)
    {
        $request->validate([
            'rolename'=>'required',
            'selecticon'=>'required',
        ]);
        $role_data = new Role;
        $role_data->role_name = $request->rolename;
        $role_data->role_icons = $request->selecticon;
        $role_data->save();
        return back()->with('success',' Role Created Successfully');
    }
}
