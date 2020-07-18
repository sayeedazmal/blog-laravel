<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(){

      $posts = Auth::user()->favorite_to_post;
      return view('admin.post.favorite',compact('posts'));
    }
}
