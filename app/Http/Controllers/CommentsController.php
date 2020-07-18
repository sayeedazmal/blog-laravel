<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CommentsController extends Controller
{
  public function store(Request $request, $post){

    $this->validate($request,[
      'comments'       =>  'required',
      ]);
    $comment = new Comment();
    $comment->user_id = Auth::id();
    $comment->post_id = $post;
    $comment->comments = $request->comments;
    $comment->save();
    Toastr::Success('this comments is successfully submitted','success');
    return redirect()->back();

  }


}
