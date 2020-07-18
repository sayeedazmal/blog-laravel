<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\catagory;
use App\Tag;
use Illuminate\Support\Facades\Session;


use App\Post;

class PostController extends Controller
{
  public function index(){
    $posts = Post::latest()->approved()->published()->paginate(6);
    return view('allpost',compact('posts'));
  }

  public function details($slug){
    $posts = Post::where('slug', $slug)->approved()->published()->first();
    $blogkey = 'blog_' .$posts->id;
    if(!Session::has($blogkey)){
       $posts->increment('view_count');
       Session::put($blogkey,1);
     }
    $randomPost = Post::approved()->published()->take(3)->inRandomOrder()->get();
    return view('postdetails',compact('posts','randomPost'));
  }

  public function postByCategory($slug){
    $category = Catagory::Where('slug',$slug)->first();
    $posts = $category->posts()->approved()->published()->get();
    return view('allcategory',compact('posts'));
    }

  public function postByTags($slug){
    $tag = Tag::where('slug', $slug)->first();
   $tags = $tag->posts()->approved()->published()->get();
    return view('alltage',compact('tags'));
    }
}
