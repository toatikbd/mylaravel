<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if (isset($image)) {
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if brand Dir exists
            if (!Storage::disk('public')->exists('brand')) {
                Storage::disk('public')->makeDirectory('brand');
            }
            $brandImage = Image::make($image)->stream();
            Storage::disk('public')->put('brand/' . $imageName, $brandImage);
        } else {
            $imageName = 'default.png';
        }

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->image = $imageName;
        if (isset($request->status)) {
            $brand->status = true;
        } else {
            $brand->status = false;
        }
        $brand->save();
        Toastr::success('Brand Successfully Saved', 'Success');
        return redirect()->route('admin.brand.index');
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
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
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
        $this->validate($request, [
            'name' => 'required',
            'image' =>  'image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $brand = Brand::find($id);
        if (isset($image)) {
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if brand Dir exists
            if (!Storage::disk('public')->exists('brand')) {
                Storage::disk('public')->makeDirectory('brand');
            }
            // delete old image
            if (Storage::disk('public')->exists('brand/' . $brand->image)) {
                Storage::disk('public')->delete('brand/' . $brand->image);
            }

            $brandImage = Image::make($image)->stream();
            Storage::disk('public')->put('brand/' . $imageName, $brandImage);
        } else {
            $imageName = $brand->image;
        }

        $brand->name = $request->name;
        $brand->image = $imageName;
        if (isset($request->status)) {
            $brand->status = true;
        } else {
            $brand->status = false;
        }
        $brand->save();
        Toastr::success('Brand  Updated Successfully', 'Success');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if (Storage::disk('public')->exists('brand/' . $brand->image)) {
            Storage::disk('public')->delete('brand/' . $brand->image);
        }

        $brand->delete();
        Toastr::success('Brand Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
