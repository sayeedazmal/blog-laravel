<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function add($post){

      $user = Auth::user();
      $isFavorite = $user->favorite_to_post()->where('post_id', $post)->count();

      if($isFavorite==0){
        $user->favorite_to_post()->attach($post);
        Toastr::success('post successfully added to favorite list','success');
        return redirect()->back();
      }else{
        $user->favorite_to_post()->detach($post);
        Toastr::success('post successfully removed from your favorite list','success');
        return redirect()->back();
      }
    }
}
