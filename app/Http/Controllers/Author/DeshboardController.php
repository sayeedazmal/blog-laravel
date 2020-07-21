<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class DeshboardController extends Controller
{
    public function index(){

      $user = Auth::user();
     $posts = $user->posts;
     $populer_post = $user->posts()
      ->withCount('comments')
      ->withCount('favourite_to_users')
      ->orderBy('view_count','desc')
      ->orderBy('comments_count')
      ->orderBy('favourite_to_users_count')
      ->take(5)->get();
    $total_panding_post = $posts->where('is_aproved',false);
    $all_views = $posts->sum('view_count');
    return view('author.deshboard',compact('posts','populer_post','total_panding_post','all_views'));
    }
}
