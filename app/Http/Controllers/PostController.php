<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use File;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function addpost_form()
  {
    return view('Admin.Post.createpost');
  }


  public function save_post(Request $req)
  {
    
    if ($req->file) {
      $fileName   = time() . $req->file->getClientOriginalName();
      $path = public_path() . '/post_images';
      $uplaod = $req->file->move($path, $fileName);
      $uploaddb = '/post_images' . '/' . $fileName;
    }
   
    $req->validate([
      'postname' => 'required | unique:posts,post_name',
      'postdesc' => 'required',

    ]);
   
    $slug = strtolower($req->postname);
    $arr = explode(" ", $slug);
    $string_slug = implode("-", $arr);
    $status = 1;
    $data = [
      'post_name' => $req->postname,
      'post_desc' =>  $req->postdesc,
      'post_image' =>  $uploaddb,
      'status' => $status,
      'user_id' => Auth::user()->id,
    ];
    

    $data1 = Post::create($data);

    $slug_id =  $data1->id;
    $new_slug_t = $string_slug . '_' . $slug_id;
    $update = Post::find($data1->id)->update([
      'post_slug' => $new_slug_t,
    ]);


    return redirect('all-posts');
  }

  public function getallposts(Request $request)
  {
    $posts  = Post::all();
    return view('Admin.Post.posts')->with('post', $posts);
  }

  public function deletepost($id)
  {

    $post = Post::find($id);
    if (empty($post)) {
      return;
    }



    // delete related  

    $post->delete();

    return redirect('all-posts');
  }

  public function editpost(Request $req, $id)
  {
    $post = Post::find($id);
    $old_image = $post->post_image;


    if ($req->hasFile('image')) {
      if (file_exists(public_path($old_image))) {

        unlink(public_path($old_image));
      }

      $fileName   = time() . $req->file->getClientOriginalName();
      $path = public_path() . '/post_images';
      $uplaod = $req->file->move($path, $fileName);
      $uploaddb = '/post_images' . '/' . $fileName;


      Post::where('id', $id)->update([
        'image' =>  $uploaddb,
      ]);
    } else {
      $post->post_image = $old_image;
    }

    $post = Post::find($id);
    return view('Admin.Post.editpost')->with('post', $post);
  }
  public function updatepost(Request $req, $id)
  {
    $post_to_update = Post::where('id', $id)->first();

    if ($req->file) {
      $fileName   = time() . $req->file->getClientOriginalName();
      $uploaddb = '/post_images' . '/' . $fileName;
      $path = public_path() . '/post_images';
      $uplaod = $req->file->move($path, $fileName);

      $post_to_update->post_image =   $uploaddb;
    }
    $post_to_update->post_name = $req->postname;
    $post_to_update->post_desc = $req->postdesc;


    $post_to_update->save();
    return redirect('all-posts');
  }

  
  
  public function changestatus(Request $req)
  {
    $post = Post::find($req->post_id);

    if ($post->status == 1) {
      $post->status = 0;
    } else {
      $post->status = 1;
    }
    $post->save();
    return response()->json("done");
  }

  
  
  
  public function viewpost($id)
  {
    $post = Post::find($id);
    return view('Admin.Post.view')->with('post', $post);
  }
}
