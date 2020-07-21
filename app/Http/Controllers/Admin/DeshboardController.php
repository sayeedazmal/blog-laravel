<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\post;
use App\Catagory;
use App\Tag;
use App\User;
use Carbon\Carbon;

class DeshboardController extends Controller
{
    public function index()
    {

       $posts = post::all();
       $populer_posts = post::withCount('comments')
         ->withCount('favourite_to_users')
         ->orderBy('view_count','desc')
         ->orderBy('comments_count','desc')
         ->orderBy('favourite_to_users_count','desc')
         ->take(5)->get();
     $total_panding_posts = post::where('is_aproved',false)->count();
     $all_views = post::sum('view_count');
     $author_count = User::where('role_id',2)->count();
     $new_authors_today  = User::where('role_id',2)
                          ->whereDate('created_at',Carbon::today())
                          ->count();
    $active_user = User::where('role_id',2)
                          ->withCount('posts')
                          ->withCount('comments')
                          ->withCount('favorite_to_post')
                          ->orderBy('posts_count','desc')
                          ->orderBy('comments_count','desc')
                          ->orderBy('favorite_to_post_count','desc')->get();
    $all_category = Catagory::all()->count();
    $all_tags = Tag::all()->count();




      return  view('admin.deshboard',compact('posts','populer_posts','total_panding_posts','all_views','author_count','new_authors_today','active_user','all_category','all_tags'));
    }

}
