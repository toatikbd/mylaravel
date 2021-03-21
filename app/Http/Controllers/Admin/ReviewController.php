<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Review;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('admin.review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.review.create');
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
            'job_title' => 'required',
            'review_text' => 'required',
            'review_count' => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if (isset($image)) {
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if review Dir exists
            if (!Storage::disk('public')->exists('review')) {
                Storage::disk('public')->makeDirectory('review');
            }
            $reviewImage = Image::make($image)->crop(150, 150)->stream();
            Storage::disk('public')->put('review/' . $imageName, $reviewImage);
            
        } else {
            $imageName = 'default.png';
        }

        $review = new Review();
        $review->name = $request->name;
        $review->job_title = $request->job_title;
        $review->image = $imageName;
        $review->review_count = $request->review_count;
        $review->review_text = $request->review_text;
        if (isset($request->status)) {
            $review->status = true;
        } else {
            $review->status = false;
        }
        $review->save();
        Toastr::success('Review Successfully Saved', 'Success');
        return redirect()->route('admin.review.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);
        return view('admin.review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);
        return view('admin.review.edit', compact('review'));
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
            'job_title' => 'required',
            'review_text' => 'required',
            'review_count' => 'required',
            'image' =>  'image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);
        $review = Review::find($id);
        if (isset($image)) {
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if review Dir exists
            if (!Storage::disk('public')->exists('review')) {
                Storage::disk('public')->makeDirectory('review');
            }
            // delete old image
            if (Storage::disk('public')->exists('review/' . $review->image)) {
                Storage::disk('public')->delete('review/' . $review->image);
            }

            $reviewImage = Image::make($image)->crop(150, 150)->stream();
            Storage::disk('public')->put('review/' . $imageName, $reviewImage);
        } else {
            $imageName = $review->image;
        }

        $review->name = $request->name;
        $review->job_title = $request->job_title;
        $review->image = $imageName;
        $review->review_count = $request->review_count;
        $review->review_text = $request->review_text;
        if (isset($request->status)) {
            $review->status = true;
        } else {
            $review->status = false;
        }
        $review->save();
        Toastr::success('Review Updated Successfully', 'Success');
        return redirect()->route('admin.review.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        if (Storage::disk('public')->exists('review/' . $review->image)) {
            Storage::disk('public')->delete('review/' . $review->image);
        }

        $review->delete();
        Toastr::success('Review Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
