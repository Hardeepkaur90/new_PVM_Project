<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SettingController;
use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin',[AuthenticationController::class,'login'])->name('admin');
Route::post('login/post',[AuthenticationController::class,'login_store'])->name('login/post');
Route::get('register',[AuthenticationController::class,'register'])->name('register');
Route::post('register/post',[AuthenticationController::class,'store'])->name('register/post');
Route::get('logout',[AuthenticationController::class,'logout'])->name('logout');



// AdminController
Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard')->name('loginmiddleware');


// IconController
Route::get('icons',[IconController::class,'icons'])->name('icons');
Route::post('add_icons',[IconController::class,'add_icons'])->name('add_icons');


// Modules 
Route::get('list-modules',[ModuleController::class,'list_modules'])->name('list-modules');
Route::get('modules',[ModuleController::class,'modules'])->name('modules');
Route::post('add-modules',[ModuleController::class,'add_modules'])->name('add-modules');




Route::get('change',[SettingController::class,'changepassword'])->name('change');
Route::post('change/password',[SettingController::class,'pass_changed'])->name('change/password');

Route::get('global_settings',[SettingController::class,'globalsetting'])->name('global_settings');
Route::get('create_settings',[SettingController::class,'create_settings'])->name('create_settings');
Route::post('create_settings/post',[SettingController::class,'post_settings'])->name('create_settings/post');
Route::get('edit_settings/{id}',[SettingController::class,'edit_settings'])->name('edit_settings');
Route::post('edit/post_settings/{id}',[SettingController::class,'update']);






// --------------------------------menu crud--------------------------------------------

Route::post("created", [MenuController::class, 'addmenu']);

Route::get("menu", [MenuController::class, 'showmenu']);

Route::get("menu/delete/{id}", [MenuController::class, 'deletemenu']);

Route::get("menu/edit/{id}", [MenuController::class, 'viewmenu']);

Route::post("updated", [MenuController::class, 'updatemenu']);