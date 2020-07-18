<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscribe;
use Brian2694\Toastr\Facades\Toastr;

class Newsubscriber extends Controller
{
    public function store(Request $request){
      $this->validate($request,[
        'email' => 'required|unique:subscribes',
      ]);
      $subscribepost = new Subscribe();
      $subscribepost->email = $request->email;
      $subscribepost->save();
      Toastr::Success('thanks for subscribe','sucess');
      return redirect()->back();


    }
}
