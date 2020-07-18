<?php

namespace App\Http\Controllers\Admin;
use App\Catagory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class CatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $catagories = Catagory::latest()->get();
      return view('admin.catagory.index',compact('catagories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catagory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request , [
            'name'          => 'required|unique:catagories',
            'image'         =>  'required|mimes:jpeg,bmp,png,jpg',
        ]);

        // Get Form Image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // Check if Category Dir exists
            if (!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }
            // Resize image for category and upload
            //$categoryImage = Image::make($image)->resize(1600,479)->save();
            $categoryImage = Image::make($image)->resize(1600,800)->stream();
            Storage::disk('public')->put('category/'.$imageName, $categoryImage);

            // Check if Category Slider Dir exists
            if (!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // Resize image for category slider and upload
            //$categorySlider = Image::make($image)->resize(500,333)->save();
            $categorySlider = Image::make($image)->resize(1600,800)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName, $categorySlider);

        }
        else
        {
            $imageName = 'default.png';
        }

        $category = new Catagory();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;

        $category->save();
        Toastr::success('Category Saved Successfully','Success');
        return redirect()->route('admin.catagory.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catagories = Catagory::find($id);
        return view('admin.catagory.edit',compact('catagories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request , [
            'name'          => 'required',
            'image'         =>  'mimes:jpeg,bmp,png,jpg',
        ]);

        // Get Form Image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $category = Catagory::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // Check if Category Dir exists
            if (!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            // delete of existing category image when doing the update

            if(storage::disk('public')->exists('category/'.$category->image)){
              Storage::disk('public')->delete('category/'.$category->image);
            }


            // Resize image for category and upload
            //$categoryImage = Image::make($image)->resize(1600,479)->save();
            $categoryImage = Image::make($image)->resize(1600,479)->stream();
            Storage::disk('public')->put('category/'.$imageName, $categoryImage);

            // Check if Category Slider Dir exists
            if (!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            // delete of existing slider image when doing the update
          if(storage::disk('public')->exists('category/slider'.$category->image)){
            Storage::disk('public')->delete('category/slider'.$category->image);
          }
            // Resize image for category slider and upload
            $categorySlider = Image::make($image)->resize(1600,479)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName, $categorySlider);



        }
        else
        {
          $imageName= $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;

        $category->save();
        Toastr::success('Category updated Successfully ','Success');
        return redirect()->route('admin.catagory.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

              $ctg = Catagory::find($id);

          if (Storage::disk('public')->exists('category/'.$ctg->image)) {
              Storage::disk('public')->delete('category/'.$ctg->image);
          }
          if (Storage::disk('public')->exists('category/slider/'.$ctg->image)) {
              Storage::disk('public')->delete('category/slider/' .$ctg->image);
          }
              $ctg->delete();
              Toastr::success('deleted successfully','Success');
              return redirect()->back();
    }
}
