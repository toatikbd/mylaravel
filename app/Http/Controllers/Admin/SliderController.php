<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);
        if (isset($image)) {
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if slider Dir exists
            if (!Storage::disk('public')->exists('slider')) {
                Storage::disk('public')->makeDirectory('slider');
            }
            $sliderImage = Image::make($image)->stream();
            Storage::disk('public')->put('slider/' . $imageName, $sliderImage);
            
        } else {
            $imageName = 'default.png';
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->link = $request->link;
        $slider->image = $imageName;
        if (isset($request->status)) {
            $slider->status = true;
        } else {
            $slider->status = false;
        }
        $slider->save();
        Toastr::success('Slider Successfully Saved', 'Success');
        return redirect()->route('admin.slider.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
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
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'link' => 'required',
            'image' =>  'image|mimes:jpeg,png,jpg,svg'
        ]);

        
        $slug = Str::slug($request->title);
        $slider = Slider::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if slider Dir exists
            if (!Storage::disk('public')->exists('slider')) {
                Storage::disk('public')->makeDirectory('slider');
            }
            // delete old image
            if (Storage::disk('public')->exists('slider/' . $slider->image)) {
                Storage::disk('public')->delete('slider/' . $slider->image);
            }

            $sliderImage = Image::make($image)->stream();
            Storage::disk('public')->put('slider/' . $imageName, $sliderImage);
        } else {
            $imageName = $slider->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->link = $request->link;
        $slider->image = $imageName;
        if (isset($request->status)) {
            $slider->status = true;
        } else {
            $slider->status = false;
        }
        $slider->save();
        Toastr::success('Slider Updated Successfully', 'Success');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if (Storage::disk('public')->exists('slider/' . $slider->image)) {
            Storage::disk('public')->delete('slider/' . $slider->image);
        }

        $slider->delete();
        Toastr::success('Slider Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
