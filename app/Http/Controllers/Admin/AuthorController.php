<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Brian2694\Toastr\Facades\Toastr;

class AuthorController extends Controller
{
    public function index(){

      $authors = User::authors()
      ->withCount('posts')
      ->withCount('favorite_to_post')
      ->withCount('comments')
      ->get();
      return view('admin.author',compact('authors'));
    }

    public function destroy($id){
    $author = User::findOrFail($id)->delete();
    Toastr::Success('Author Successfully deleted','success');
    return redirect()->back();
    }
}
