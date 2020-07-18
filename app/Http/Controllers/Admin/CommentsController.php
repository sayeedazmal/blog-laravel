<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Comment;

class CommentsController extends Controller
{
  public function index(){
    $comments = Comment::latest()->get();
    return view('admin.comment', compact('comments'));
  }
  public function destroy($id){
    Comment::findOrFail($id)->delete();
    toastr::Success('Comments deleted successfully','sucess');
    return redirect()->back();
  }
}
