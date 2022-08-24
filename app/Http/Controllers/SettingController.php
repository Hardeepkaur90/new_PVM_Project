<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class SettingController extends Controller
{
    //
    public function globalsetting()
    {
        $setting = Setting::join('colors', 'colors.id', '=', 'navbar_color')->get([
            'settings.id as id','colors.id as color_id','navbar_color','logo_image','site_name','contact_email','contact_phone','color_name','color_code',
        ]);
        return view('Admin.settings.global_settings', compact('setting'));
    }

    public function create_settings()
    {
        $color = Color::all();
        return view('Admin.settings.create_globalSetting', compact('color'));
    }


    public function post_settings(Request $request)
    {
        $request->validate([
            'themecolor' => 'required',
            'logoimage' => 'required',
            'sitename' => 'required',
            'contactemail' => 'required',
            'contactphone' => 'required',
        ]);

        $settings = new Setting;
        $settings->navbar_color = $request->themecolor;
        $logo_img = time() . '.' . $request->logoimage->extension();
        $request->logoimage->move(public_path('logo_img'), $logo_img);
        $settings->logo_image = $logo_img;
        $settings->site_name = $request->sitename;
        $settings->contact_email = $request->contactemail;
        $settings->contact_phone = $request->contactphone;
        $settings->save();
        return back()->with('success', ' Inserted Successfully');
    }




    public function edit_settings(Request $request, $id)
    {
        $color = Color::all();
        $data = Setting::where('id',$id)->first();
        return view('Admin.settings.edit_settings',compact('data','color'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'themecolor' => 'required',
            'logoimage' => 'required',
            'sitename' => 'required',
            'contactemail' => 'required',
            'contactphone' => 'required',
        ]);

        if ($request->hasFile('logoimage')) {
            $image = $request->file('logoimage');
            $name_gen = time() . rand(1, 999999);
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $location = 'logo_img/';
            $last_img = $img_name;
            $image->move($location, $img_name);
        }

        $updatesetting = Setting::find($id);
        $color = $request->themecolor;
        $logoimage = $last_img;
        $sitename = $request->sitename;
        $contactemail = $request->contactemail;
        $contactphone = $request->contactphone;

        $update = Setting::where('id', $id)->update([
            'navbar_color' => $color,
            'logo_image' => $logoimage,
            'site_name' => $sitename,
            'contact_email' => $contactemail,
            'contact_phone' => $contactphone,
        ]);
        return back()->with('success', 'Inserted Successfully');
    }

    public function changepassword(){
        return view('Admin.settings.changepassword');
    }

    public function pass_changed(Request $request)
    {
        $request->validate([
            'currentpassword'=>'required',
            'newpassword'=>'required',
            'password_confirmation'=>'required',
        ]);

        $email = Auth::user()->email;
        $currentpassword = $request->currentpassword;
        $new_pass = $request->newpassword;
        $userdata = User::where('email',$email)->get();

        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {
           
            return back()->with('danger',' Password Not Matched ');
        }
        else{
            $user = Auth::user();
            $password = $user->password;
            $new_password = bcrypt($new_pass);
            $update = User::where('email', $email)->update(['password' => $new_password]);
            return back()->with('success',' Password Changed Successfully');
       
        
    }
    }
  
}
