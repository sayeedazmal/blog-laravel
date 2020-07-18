<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
// Model Class Create
use App\Post;
use App\Catagory;
use App\Tag;
use App\Subscribe;
//End Model Class Create
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewPostApproved;
use App\Notifications\NewPostNotify;
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
      $posts = Post::latest()->get();
      return view('admin.post.index',compact('posts'));
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
        return view('admin.post.create', compact('categories','tags'));
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
       $post->is_aproved = true;


      $post->save();
      $post->catagories()->attach($request->categories);
      $post->tags()->attach($request->tag);

      $subscriber = Subscribe::all();
        foreach ($subscriber as $subscriber) {
         Notification::route('mail',$subscriber->email)
         ->notify(new NewPostNotify($post));
        }

      $post->save();
      Toastr::success('post Saved Successfully','Success');
      return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

      $categories = Catagory::all();
      $tags = Tag::all();
       return view('admin.post.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
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
        Storage::disk('public')->makeDirectory('post');
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
     $post->is_aproved = true;


    $post->save();
    $post->catagories()->sync($request->categories);
    $post->tags()->sync($request->tag);


    $post->save();
    Toastr::success('post updated Successfully','Success');
    return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image)){
          Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->catagories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('post deleted successfully','Success');
        return redirect()->route('admin.post.index');
    }

    public function panding(){
      $posts = Post::where('is_aproved',false)->get();
      return view('admin.post.pandingpost',compact('posts'));
    }
    public function approval($id){
      $post = Post::find($id);
      if($post->is_aproved == false){
        $post->is_aproved = true;
        $post->save();

        $post->user->notify(new NewPostApproved($post));
        Toastr::success('post aproved successfully','Success');
      }else{
        Toastr::success('post aproved allready exists','Success');
      }
      return redirect()->back();
    }

}
