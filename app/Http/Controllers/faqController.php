<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class faqController extends Controller
{
    function addfaq(Request $req)
    {
        $req->validate([
            'question' => 'required',
            'answer' => 'required',

        ]);
        $faq = new faq;
        $faq->question = $req->question;
        $faq->answer = $req->answer;
        $result = $faq->save();
        if ($result) {
            return redirect('faq-list')->with('success', 'FAQ added successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    function deletefaq($id)
    {

        $data = faq::find($id);
        $data->delete();
        return redirect('faq-list')->with('success', 'Deleted Faq successfully');
    }

    public function show_faq()
    {
        $data = faq::all();
        return view('Admin.FAQ.faq_list')->with('data', $data);
    }


    function viewfaq($id)
    {

        $data = faq::find($id);

        return view('Admin.FAQ.edit_faq', ['data' => $data]);
    }

    function updatefaq(Request $req)
    {
        $req->validate([
            'question' => 'required',
            'answer' => 'required'

        ]);
        $faq = faq::find($req->id);
        $faq->question = $req->question;
        $faq->answer = $req->answer;
        $result = $faq->save();
        if ($result) {
            return redirect('faq-list')->with('success', ' updated FAQ successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    // public function display_faq()
    // {
    //     $data = faq::all();
    //     $page = Page::where('title', '=', 'FAQ')->first(['title', 'page_description', 'sub_description', 'image', 'url']);
    //     $nav = Page::where('show', '=', '1')->get(['title', 'page_description', 'sub_description', 'image', 'url']);
    //     return view('faq')->with('faq', $data)->with('content', $page)->with('nav', $nav);
    // }
}