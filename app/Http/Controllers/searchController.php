<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;

class searchController extends Controller
{
  public function search(Request $request){

    $query = $request->input('query');
    $posts = Post::where('title','like',"%$query%")->approved()->published()->get();
    return view('search',compact('posts','query'));
  }
}
