<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscribe;
use Brian2694\Toastr\Facades\Toastr;

class SubscribeController extends Controller
{
  public function index(){
    $subscribemail = Subscribe::latest()->get();
    return view('admin.subscribe',compact('subscribemail'));

  }
  public function destroy($subscribes){

    $subscribe = Subscribe::findOrFail($subscribes)->delete();

    Toastr::Success('Subscriber is successfully Deleted:','success');
    return redirect()->back();
  }
}
