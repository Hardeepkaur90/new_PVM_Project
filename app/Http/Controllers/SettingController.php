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
        $setting = Setting::join('colors', 'colors.id', '=', 'theme_color')->get([
            'settings.id as id', 'colors.id as color_id', 'theme_color', 'logo_image', 'site_name', 'contact_email', 'contact_phone', 'color_name', 'color_code', 'copyright'
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
            'copyrighttext' => 'required',

        ]);

        $settings = new Setting;
        $settings->theme_color = $request->themecolor;
        $logo_img = time() . '.' . $request->logoimage->extension();
        $request->logoimage->move(public_path('logo_img'), $logo_img);
        $settings->logo_image = $logo_img;
        $settings->site_name = $request->sitename;
        $settings->contact_email = $request->contactemail;
        $settings->contact_phone = $request->contactphone;
        $settings->copyright = $request->copyrighttext;
        $settings->save();
        return back()->with('success', ' Inserted Successfully');
    }




    public function edit_settings(Request $request, $id)
    {
        $color = Color::all();
        $data = Setting::join('colors', 'colors.id', '=', 'theme_color')->where('settings.id', $id)->first([
            'settings.id as settings_id',
            'colors.id as color_id',
            'theme_color',
            'logo_image',
            'site_name',
            'contact_email',
            'contact_phone',
            'copyright',
            'color_name',
            'color_code',

        ]);
        return view('Admin.settings.edit_settings', compact('data', 'color'));
    }

    public function update(Request $request, $id)
    {

        $setting_edit = Setting::where('id', $id)->first();
        $old_image = public_path('logo_img/' . $setting_edit->logo_image);

        if ($request->hasFile('logoimage')) {
            if (Setting::exists($old_image)) {
                unlink(($old_image));
            }

            $image = $request->file('logoimage');
            $image_name = time() . "_" . $image->getClientOriginalName();
            $image->move('logo_img/', $image_name);
            $setting_edit->logo_image = $image_name;
            Setting::where('id', $id)->update([
                'logo_image' => $image_name,
            ]);
        } else {
            $setting_edit->logo_image = $old_image;
        }

        $updatesetting = Setting::find($id);
        $color = $request->themecolor;
        $sitename = $request->sitename;
        $contactemail = $request->contactemail;
        $contactphone = $request->contactphone;
        $copyright = $request->copyrighttext;

        $update = Setting::where('id', $id)->update([
            'theme_color' => $color,
            'site_name' => $sitename,
            'contact_email' => $contactemail,
            'contact_phone' => $contactphone,
            'copyright' => $copyright,
        ]);
        return back()->with('success', 'Inserted Successfully');
    }

    public function changepassword()
    {
        return view('Admin.settings.changepassword');
    }

    public function pass_changed(Request $request)
    {
        $request->validate([
            'currentpassword' => 'required',
            'newpassword' => 'required',
            'password_confirmation' => 'required',
        ]);

        $email = Auth::user()->email;
        $currentpassword = $request->currentpassword;
        $new_pass = $request->newpassword;
        $userdata = User::where('email', $email)->get();

        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {

            return back()->with('danger', ' Password Not Matched ');
        } else {
            $user = Auth::user();
            $password = $user->password;
            $new_password = bcrypt($new_pass);
            $update = User::where('email', $email)->update(['password' => $new_password]);
            return back()->with('success', ' Password Changed Successfully');
        }
    }
}
