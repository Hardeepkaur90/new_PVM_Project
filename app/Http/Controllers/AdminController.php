<?php

namespace App\Http\Controllers;

use Facade\Ignition\DumpRecorder\DumpHandler;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    //
    public function dashboard(Request $req){ 
        return view('Admin.dashboard');
        // return view('Admin.Menu.menus')
        // return "123";
    }

    public function list_users()
    {
        $admin = Admin::join('roles','roles.id','=','admin_role')->get([
            'name',
            'email',
            'image',
            'roles.id as role_id',
            'role_name',
            'admins.id'
        ]);    
        return view('Admin.Staff.list_admins',compact('admin'));
    }
    public function add_admins(){
        $role = Role::all();
        return view('Admin.Staff.add_admins',compact('role'));
    }

    public function add_admin_post(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'image'=>'required',
            'rolename'=>'required|not_in:0',
        ]);

        $admin_data = new Admin;
        $admin_img = time() . '.' . $request->image->extension();
        $request->image->move(public_path('sub_admin_img'),$admin_img);
        $admin_data->name = $request->name;
        $admin_data->email = $request->email;
        $admin_data->password = Hash::make($request->password);
        $admin_data->image = $admin_img;
        $admin_data->admin_role = $request->rolename;
        $admin_data->save();
        return back()->with('success','Sub Admin Created Successfully');
    }

    public function edit_admins($id){
        $admin_edit = Admin::where('id',$id)->first();
        $role_edit = Role::all();
        return view('Admin.Staff.edit_admins',compact('admin_edit','role_edit'));
    }

    
    
    public function edit_staff_post(Request $request,$id)
    {
        $name = $request->name;
        $email = $request->email;
        $rolename = $request->rolename;
        $data = Admin::find($id);
        $old_image = public_path('sub_admin_img/' . $data->image);

        if ($request->hasFile('image')) {
            if (Admin::exists($old_image)) {
                unlink(($old_image));
            }

            $image = $request->file('image');
            $image_name = time() . "_" . $image->getClientOriginalName();
            $image->move('Page_images', $image_name);
            $data->image = $image_name;
            Admin::where('id', $id)->update([
                'image' => $image_name,
            ]);
        } 
        else 
        {
            $data->image = $old_image;
        }
        $update = Admin::where('id', $id)->update([
            'name'=>$name,
            'email'=>$email,
            'admin_role'=>$rolename
        ]);
        return redirect('list/pages')->with('success', 'Updated Successfully');

    }

    public function viewStaff($id)
    {
        // $admin_data = Admin::where('id',$id)->first();
        $admin_data = Admin::join('roles','roles.id','=','admin_role')->where('admins.id',$id)->first([
            'name',
            'email',
            'image',
            'roles.id as role_id',
            'role_name',
            'admins.id'
        ]);
      
        return view('Admin.Staff.view_staff',compact('admin_data'));
    }

}
