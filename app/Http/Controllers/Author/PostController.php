<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\post;
use App\User;
use App\Catagory;
use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Newnotification;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Auth::User()->posts()->latest()->get();
      return view('author.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Catagory::all();
      $tags = Tag::all();
      return view('author.post.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'title'       =>  'required',
        'categories'  =>  'required',
        'tag'         =>  'required',
        'body'        =>  'required',
        'image'       =>  'required|mimes:jpeg,bmp,png,jpg',

      ]);
    $image = $request->file('image');
    $slug = str_slug($request->title);




    if(isset($image)){
      $currentDate = Carbon::now()->toDateString();
      $imageName = $slug .''.$currentDate .''.uniqid().'.'.$image->getClientOriginalExtension();

      // image directory create and put image in such folder
      if(!Storage::disk('public')->exists('post')){
        Storage::disk('public')->makeDirectory('post');}

      $postImage = Image::make($image)->resize(1600,479)->stream();
      Storage::disk('public')->put('post/'.$imageName, $postImage);


    //EndOf image directory create and put image in such folder
  }else{
    $imageName='default.png';
  }


    $post = new post();
    $post->user_id = Auth::id();
    $post->title = $request->title;
    $post->slug = $slug;
    $post->body = $request->body;
    $post->image = $imageName;
    $post->status = $request->status;

    if (isset($request->status)) {
        $post->status = true;
      }else {
        $post->status = false;
      }
     $post->is_aproved = false;


    $post->save();
    $post->catagories()->attach($request->categories);
    $post->tags()->attach($request->tag);
    $post->save();

    $users = User::where('role_id','1')->get();
    Notification::send($users, new Newnotification($post));

    Toastr::success('post Saved Successfully','Success');
    return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
      if ($post->user_id != Auth::id()) {
        Toastr:: warning('you are not show this!!!','Warning');
        return redirect()->back();
      }
      return view('author.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
      if ($post->user_id != Auth::id()) {
        Toastr:: warning('you are not edit this!!!','Warning');
        return redirect()->back();
      }
      $categories = Catagory::all();
      $tags = Tag::all();
       return view('author.post.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
      $this->validate($request,[
        'title'       =>  'required',
        'categories'  =>  'required',
        'tag'         =>  'required',
        'body'        =>  'required',
        'image'       =>  'image',

      ]);
    $image = $request->file('image');
    $slug = str_slug($request->title);




    if(isset($image)){
      $currentDate = Carbon::now()->toDateString();
      $imageName = $slug .''.$currentDate .''.uniqid().'.'.$image->getClientOriginalExtension();

      // image directory create and put image in such folder


      if(!Storage::disk('public')->exists('post')){
        Storage::disk('public')->delete('post');
      }
      // old image delete
      if(storage::disk('public')->exists('post/'.$post->image)){
        Storage::disk('public')->delete('post/'.$post->image);
      }
      $postImage = Image::make($image)->resize(1600,479)->stream();
      Storage::disk('public')->put('post/'.$imageName, $postImage);


    //EndOf image directory create and put image in such folder
  }else{
    $imageName=$post->image;
  }

    $post->user_id = Auth::id();
    $post->title = $request->title;
    $post->slug = $slug;
    $post->body = $request->body;
    $post->image = $imageName;
    $post->status = $request->status;

    if (isset($request->status)) {
        $post->status = true;
      }else {
        $post->status = false;
      }
     $post->is_aproved = false;


    $post->save();
    $post->catagories()->sync($request->categories);
    $post->tags()->sync($request->tag);


    $post->save();
    Toastr::success('post updated Successfully','Success');
    return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
      if ($post->user_id != Auth::id()) {
        Toastr:: warning('you are not delete this!!!','Warning');
        return redirect()->back();
      }
      if(Storage::disk('public')->exists('post/'.$post->image)){
        Storage::disk('public')->delete('post/'.$post->image);
      }
      $post->catagories()->detach();
      $post->tags()->detach();
      $post->delete();
      Toastr::success('post deleted successfully','Success');
      return redirect()->route('author.post.index');
    }

}
