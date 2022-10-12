<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\DataTables\PageDataTable;



class PageController extends Controller
{
    //
    public function list_pages(PageDataTable $dataTable)
    {
        $pages = Page::all();
        return $dataTable->render('Admin.page.list_pages', compact('pages'));
        
        // return view('Admin.page.list_pages', compact('pages'));
    }
    public function pagesearch(Request $request)
    {
        $pages = Page::all();
        if ($request->keyword != '') {
            $pages = Page::where('title', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        return response()->json([
            'pages' => $pages
        ]);
    }

    public function add_pages()
    {
        return view('Admin.page.add_pages');
    }


    function seo_friendly_url($string){
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
        return strtolower(trim($string, '-'));
    }

    public function add_pagesPost(Request $request)
    {
        $request->validate([
            'pagetitle' => 'required',
            'image' => 'required',
            'pagedescription' => 'required',
        ]);
        $pagedata = new Page;
        $pagedata->title = $request->pagetitle;
        $pagedata->description = $request->pagedescription;
        $page_img = time() . '.' . $request->image->extension();
        $request->image->move(public_path('Page_images'), $page_img);
        $pagedata->image = $page_img;
        $pagedata->status = 1;
        $pagedata->save();
        $id = $pagedata->id;
        $slug = $this->seo_friendly_url($request->pagetitle);
        $slugupdate = $slug.'_'.$pagedata->id;
        $update = Page::find($id)->update([
            'page_slug'=>$slugupdate,
        ]);
        return redirect("list/pages")->with('success', ' Page Added Successfully');
    }

    
    
    
    
    
    
    
    
    
    
    public function edit_pages($id)
    {
        $pageedit = Page::where('id', $id)->first();

        return view('Admin.page.edit_page', compact('pageedit'));
    }

    public function edit_pagesPost(Request $request, $id)
    {
        $title = $request->pagetitle;
        $description = $request->pagedescription;


        // if ($request->hasFile('image') && request('image') != '') {
        //     $image = $request->file('image');
        //     $name_gen = time() . rand(1, 999999);
        //     $img_ext = strtolower($image->getClientOriginalExtension());
        //     $img_name = $name_gen . '.' . $img_ext;
        //     $location = 'Page_images/';
        //     $last_img = $img_name;
        //     $image->move($location, $img_name);
        // }

        $edit_page_data = Page::find($id);
        $old_image = public_path('Page_images/' . $edit_page_data->image);

        if ($request->hasFile('image')) {
            if (Page::exists($old_image)) {
                unlink(($old_image));
            }

            $image = $request->file('image');
            $image_name = time() . "_" . $image->getClientOriginalName();
            $image->move('Page_images', $image_name);
            $edit_page_data->image = $image_name;
            Page::where('id', $id)->update([
                'image' => $image_name,
            ]);
        } 
        else 
        {
            $edit_page_data->image = $old_image;
        }


        $update = Page::where('id', $id)->update([
            'title' => $title,
            'description' => $description,
        ]);
        return redirect('list/pages')->with('success', 'Updated Successfully');
    }

    public function delete_page($id)
    {
        $page_delete = Page::find($id);
        $page_delete->delete();
        return back()->with('success', 'Deleted Successfully');
    }

    public function changePagestatus(Request $request)
    {
        $status = $request->status;
        $p_id = $request->p_id;
        if ($status == '0') {
            $status = '1';
        } else {
            $status = '0';
        }
        $pagedata = Page::where('id', $p_id)->update([
            'status' => $status,
        ]);
        return "ok";
    }
}
