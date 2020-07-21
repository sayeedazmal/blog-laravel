<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Catagory;
use App\post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void

     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    $categories = Catagory::all();
    $posts = Post::latest()->approved()->published()->paginate(12);
    return view('welcome', compact('categories','posts'));
    }
}
