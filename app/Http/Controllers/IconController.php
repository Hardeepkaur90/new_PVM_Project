<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Icon;

class IconController extends Controller
{
    //
    public function icons(){
        return view('Icons.add_icons');
    }

    public function add_icons(Request $request){
        $put_icons = $request->validate([
            'icon_name'=>'required',
            'icon_image'=>'required',
        ]);
        Icon::create($put_icons);
        return back()->with('success',' Inserted Successfully');
    }
}
