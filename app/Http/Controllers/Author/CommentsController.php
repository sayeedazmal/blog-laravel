<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
  public function index(){
    $posts = Auth::user()->posts;
    return view('author.comment', compact('posts'));
  }
  public function destroy($id){

  $comments = Comment::findOrFail($id);
    if($comments->post->user->id == Auth::id()){
    $comments->delete();
    toastr::Success('Comments deleted successfully','sucess');

  }else {
      toastr::Success('you are not authenticate for delete','sucess');
      
  }
return redirect()->back();
}
}
