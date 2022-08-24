<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    //
    public function register()
    {

      return view('Admin.Auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'adminimage'=>'required',
            'password' => 'required|confirmed',
            'password_confirmation' =>'required',
        ]);

        
        $name = $request->name;
        $email = $request->email;
        $admin_img = time() . '.' . $request->adminimage->extension();
        $request->adminimage->move(public_path('admin_img'),$admin_img);
        $password = Hash::make($request->password);
        
        $adduser = new User;
        $adduser->name = $name;
        $adduser->email = $email;
        $adduser->photo = $admin_img;
        $adduser->password = $password;
        $adduser->save();
        return redirect('admin');
    }
    
    public function login()
    {
      return view('Admin.Auth.login');
    }

    
    
    
    
    public function login_store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return redirect('admin')->with('danger', 'Oppes! You have entered invalid credentials');
    }

    public function logout() {
      Auth::logout();
      return redirect('admin');
    }

   
}
