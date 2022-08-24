<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Icon;

class MenuController extends Controller
{
    //
    public function addmenu(Request $req)
    {
       $req->validate([
           'menu_title' => 'required',
           'icons' => 'required',
           'url' => 'required'
       ]);

       if (empty($req->p_menu)) {
           $menu = Menu::create([
               'menu_title' => $req->menu_title,
               'icons' => $req->icons,
               'url' => $req->url
           ]);
           return redirect('menu')->with('success', 'Menu title created successfully');
       }

       if (!empty($req->p_menu)) {
           Menu::create([
               'menu_title' => $req->menu_title,
               'p_menu' => $req->p_menu,
               'icons' => $req->icons,
               'url' => $req->url

           ]);
           return redirect('menu')->with('success', 'Menu title created successfully');
       }
   }

   public function get_menu($p_menu = 0)
   {

       $menu = DB::table('menus')->where('p_menu', $p_menu)->get();
       if (count($menu) > 0) {
           $html = "<ul id='sortable'>";
           foreach ($menu as $key => $value) {
               $html .= '<li style="list-style-type: none; "class="lists" id="menu_' . $value->id . '"><i class="nav-icon far fa-' . $value->icons . '"></i>' . $value->menu_title . '<div class="action"><a oncl ick=" oncl ick="myFunction()" href="menu/delete/' . $value->id . '"  ><i class="nav-icon far fa fa-trash"></i></a><a href="menu/edit/' . $value->id . '"style=""><i class="nav-icon far fa fa-edit " ></i></a></div></li> ';
               $html .= $this->get_menu($value->id);
           }
           $html .= "</ul>";
           return $html;
       } else {
           return false;
       }
   }


   public function showmenu()
   {
       $data = DB::table('menus')->select('id', 'p_menu', 'menu_title', 'url', 'icons', 'created_at')->get();
       $menus = $this->get_menu(0);
       $icons = Icon::all();
       $new = Menu::where('p_menu', '=', '0')->get();
       foreach ($new as $key => $name) {
           $new[$key]['submenu'] = Menu::where('p_menu', $name['id'])->get();
           foreach ($new[$key]['submenu'] as $key2 => $value) {
               $new[$key]['submenu'][$key2]['submenu3'] = Menu::where('p_menu', $value['id'])->get();
           }
       }


       return view('Admin.Menu.menus')->with('key', $data)->with('menus', $menus)->with('icon', $icons);
   }
   


   public function menulist()
   {
       $data = DB::table('menus')->select('id', 'p_menu', 'menu_title', 'url', 'icons', 'created_at')->get();
       $menus = $this->get_menu(0);
       $new = Menu::where('p_menu', '=', '0')->get();
       // dd($new);
       foreach ($new as $key => $name) {
           $new[$key]['submenu'] = Menu::where('p_menu', $name['id'])->get();
           foreach ($new[$key]['submenu'] as $key2 => $value) {
               $new[$key]['submenu'][$key2]['submenu3'] = Menu::where('p_menu', $value['id'])->get();
           }
           // dd($name);
       }
       return view('Admin.Menu.menus')->with('key', $data)->with('newkey', $new)->with('menus', $menus);
   }


   function deletemenu($id)
   {

       $data = Menu::find($id);

       $data->delete();

       return back()->with('success', 'Menu deleted successfully');
   }

   function deletesubmenu($id)
   {

       $data = Menu::where('id', $id)->first();

       $data->delete();

       return back()->with('success', 'Sub-menu deleted successfully');
   }

   // view to edit details
   public function viewmenu($id)
   {


       $m_title = Menu::where('id', $id)->first();
       $allmenu = Menu::all();
       $icons = Icon::all();
       $parent_menu = Menu::where('id', $m_title['p_menu'])->first();
       $menus = $this->get_menu(0);

       return view('Admin.Menu.menus')->with('mval', $m_title)->with('menus', $menus)->with('allmenulist', $allmenu)
           ->with('parent', $parent_menu)->with('icon', $icons);
   }


   public function updatemenu(Request $req)
   {
       $req->validate([
           'menu_title' => 'required',
           'icons' => 'required',
           'url' => 'required'
       ]);
       if (empty($req->p_menu)) {
           $m_title = Menu::where('id', $req->id)->update([
               'menu_title' => $req->menu_title,
               'icons' => $req->icons,
               'url' => $req->url
           ]);
           return redirect('menu')->with('success', 'Updated menu successfully');
       }

       if (!empty($req->p_menu)) {

           Menu::where('id', $req->id)->update([
               'p_menu' => $req->p_menu,
               'menu_title' => $req->menu_title,
               'icons' => $req->icons,
               'url' => $req->url

           ]);
           return redirect('menu')->with('success', 'Updated menu successfully');
       }
   }
}
