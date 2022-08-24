<?php

namespace App\Http\Controllers;

use Facade\Ignition\DumpRecorder\DumpHandler;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    //
    public function dashboard(){
        return view('Admin.dashboard');
    }


}
