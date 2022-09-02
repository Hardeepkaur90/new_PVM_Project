<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class sliderController extends Controller
{
    
    
    public function addimage(Request $req)
    {
        $req->validate([
            'image' => 'required',
            'image_title' => 'required', //here user is the table name
            'description' => 'required'
        ]);
        $image = $req->file('image');
        $name_gen = time() . rand(1, 999999);
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $location = 'images/slider/';
        $last_img = $img_name;
        $image->move($location, $img_name);


        $data = new Slider;
        $data->image = $last_img;
        $data->image_title = $req->image_title;
        $data->description = $req->description;
        $data->save();

        return redirect()->back()->with('success', 'successfully added');
    }


    public function show_img()
    {
        $image = slider::get();
        return view('Admin.Sliders.slider_list')->with('sliderimg', $image);
    }


    function deleteimage($id)
    {

        $data = Slider::find($id);
        $data->delete();
        return redirect('slider-list');
    }

    function viewimage($id)
    {

        $data = Slider::find($id);
        $alldata = slider::orderBy('order')->get();
        return view('Admin.Sliders.edit_slider')->with('data', $data)->with('datalist', $alldata);
    }


    function updateimage(Request $req)
    {
        $req->validate([
            'image_title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $name_gen = time() . rand(1, 999999);
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $location = 'images/slider/';
            $last_img = $img_name;
            $image->move($location, $img_name);

            Slider::where('id', $req->id)->update([
                'image' => $last_img,

            ]);
        }

        $image = Slider::find($req->id);
        $image->image_title = $req->image_title;
        $image->description = $req->description;
        $result = $image->save();
        if ($result) {
            return redirect('slider-list')->with('success', 'Updated successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }


    function updateorder(Request $req)
    {
        $idval = $req->data1;
        $id = $req->id;
        print_r($idval);
        die();
        // foreach ($idval as $key => $var) {
        //     $idval[$key]['order'] = Slider::where('id', $var['id'])->get();
        // }
        // $data = Slider::find('id', $req->id)->update([
        //     'order' => $idval
        // ]);
        // foreach ($req->id as $idval => $id) {
        //     DB::table('sliders')->where('id', $id)->update(['order' => $idval + 1]);
        // }

        foreach ($idval as $key => $value) {
            $key = $key + 1;
            Slider::where('id', $value)->update([
                'order' => $key
            ]);

            if ($idval) {
                return redirect('slider-list')->with('success', 'Updated successfully');
            } else {
                return back()->with('fail', 'Something went wrong');
            }
        }
        // public function show_slider()
        // {
        //     $slider = slider::paginate(3);
        //     $page = Page::where('show', '=', '1')->get(['title', 'page_description', 'sub_description', 'image', 'url']);

        //     return view('home')->with('slider', $slider)->with('nav', $page);
        // }
    }
}