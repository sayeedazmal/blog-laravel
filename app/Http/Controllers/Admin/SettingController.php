<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
  public function index(){

    return view('admin.settings');
  }
  public function updateProfile(Request $request){

    $this->validate($request , [
          'name'          => 'required',
          'email'         =>  'required',
          'image'         =>'required|image'

      ]);
      $image = $request->file('image');
      $slug = str_slug($request->name);

      $user = User::findOrFail(Auth::id());


      if(isset($image)){
        $currentDate = Carbon::now()->toDateString();
        $imageName = $slug .''.$currentDate .''.uniqid().'.'.$image->getClientOriginalExtension();

        // image directory create and put image in such folder
        if(!Storage::disk('public')->exists('Profile')){
          Storage::disk('public')->makeDirectory('Profile');}

        if(Storage::disk('public')->exists('profile/'.$user->image)){
          Storage::disk('public')->delete('profile/'.$user->image);

        }

        $userimage = Image::make($image)->resize(500,500)->stream();
        Storage::disk('public')->put('profile/'.$imageName, $userimage);


      //EndOf image directory create and put image in such folder
    }else{
      $imageName= $user->image;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->image = $imageName;
    $user->about = $request->about;
    $user->save();
    Toastr::success('Profile Update Successfully','Success');
    return redirect()->back();
  }


  public function updatePassword(Request $request){

    $this->validate($request, [
      'old_password'  => 'required',
      'password'      => 'required|confirmed'

    ]);

    $hashheadPassword = Auth::user()->password;
    // dd($hashheadPassword);

    if(Hash::check($request->old_password, $hashheadPassword)){
        if(!Hash::check($request->password, $hashheadPassword)){
          $user = User::find(Auth::id());
          $user->password = Hash::make($request->password);
          $user->save();
          Toastr::success('Password update Successfully','success');
          Auth::logout();
          return redirect()->back();
        }
    }else{
      Toastr::error('old Password Not Match','error');
      return redirect()->back();
    }


  }
}
