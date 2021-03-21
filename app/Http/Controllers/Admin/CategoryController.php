<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::latest()->get();
        return view('admin.category.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories',
            'image' =>  'required|image|mimes:jpeg,png,jpg'
        ]);

        // Get Form Image
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if Category Dir exists
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
            // Resize image for category and upload
            $categoryImage = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/' . $imageName, $categoryImage);

            // Check if Category Blog Slider Dir exists
            if (!Storage::disk('public')->exists('category/blog_slider')) {
                Storage::disk('public')->makeDirectory('category/blog_slider');
            }

            // Resize image for category blog slider and upload
            $categoryBlogSlider = Image::make($image)->resize(1600, 600)->stream();
            Storage::disk('public')->put('category/blog_slider/' . $imageName, $categoryBlogSlider);
        } else {
            $imageName = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category Saved Successfully', 'Success');
        return redirect()->route('admin.category.index');
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
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
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
            'image' =>  'mimes:jpeg,png,jpg'
        ]);

        // Get Form Image
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $category = Category::find($id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if Category Dir exists
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            // delete old image
            if (Storage::disk('public')->exists('category/'.$category->image)) 
            {
                Storage::disk('public')->delete('category/'.$category->image);
            }

            // Resize image for category and upload
            $categoryImage = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/' . $imageName, $categoryImage);

            // Check if Category blog Slider Dir exists
            if (!Storage::disk('public')->exists('category/blog_slider')) {
                Storage::disk('public')->makeDirectory('category/blog_slider');
            }
            // delete old blog slider image
            if (Storage::disk('public')->exists('category/blog_slider/' . $category->image)) 
            {
                Storage::disk('public')->delete('category/blog_slider/' . $category->image);
            }
            // Resize image for category blog slider and upload
            $categoryBlogSlider = Image::make($image)->resize(500, 400)->stream();
            Storage::disk('public')->put('category/blog_slider/' . $imageName, $categoryBlogSlider);
        } else {
            $imageName = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category Updated Successfully', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category = Category::find($id);
        if (Storage::disk('public')->exists('category/' . $category->image)) {
            Storage::disk('public')->delete('category/' . $category->image);
        }
        if (Storage::disk('public')->exists('category/blog_slider/' . $category->image)) {
            Storage::disk('public')->delete('category/blog_slider/' . $category->image);
        }
        $category->delete();
        Toastr::success('Category Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
