<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Icon;
use App\Models\Module;

class ModuleController extends Controller
{
    //
    public function list_modules()
    {

        return view('Admin.Modules.list_module');
    }

    public function modules()
    {
        $icons = Icon::all();
        return view('Admin.Modules.add_module', compact('icons'));
    }

    public function add_modules(Request $request)
    { 
            $request->validate([
                // 'moduletitle' => 'required',
                'selecticon' => 'required',
                'modulename' => 'required',
                //   'moduleslug'=>'required',
            ]);
            //  $module = new Module;
            //  $module->module_title = $request->moduletitle;
            //  $module->module_icon = $request->selecticon;
            //  $module->parent_module = $request->selectparent;
            //  $module->module_name = $request->modulename;
            //  $module->module_slug = $request->moduleslug;
            //  $var = $module->save();
            // //  $var->id;
            //  dd($var);

            $var = Module::create([
                'module_icon' => $request->selecticon,
                'p_module' => $request->selectparent,
                'module_name' => $request->modulename,
                'module_slug' => $request->moduleslug,

            ]);
            Module::create([
                'module_icon' => $request->selecticon,
                'p_module' => $var->id,
                'module_name' => $request->modulename,
                'module_slug' => $request->moduleslug,
            ]);
            return back()->with('success', 'Module Created Successfully');
        
    }
}
