<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Plan;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::latest()->get();
        return view('admin.plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plan.create');
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
            'plan_title' => 'required|unique:plans',
            'plan_body' => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->plan_title);
        if (isset($image)) {
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if plan Dir exists
            if (!Storage::disk('public')->exists('plan')) {
                Storage::disk('public')->makeDirectory('plan');
            }
            $planImage = Image::make($image)->stream();
            Storage::disk('public')->put('plan/' . $imageName, $planImage);
            
        } else {
            $imageName = 'default.png';
        }
        $plan = new Plan();
        $plan->plan_title = $request->plan_title;
        $plan->plan_body = $request->plan_body;
        $plan->image = $imageName;
        if (isset($request->status)) {
            $plan->status = true;
        } else {
            $plan->status = false;
        }
        $plan->save();
        Toastr::success('Plan Successfully Saved', 'Success');
        return redirect()->route('admin.plan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::find($id);
        return view('admin.plan.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::find($id);
        return view('admin.plan.edit', compact('plan'));
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
            'plan_title' => 'required',
            'plan_body' => 'required',
            'image' =>  'image|mimes:jpeg,png,jpg,svg'
        ]);

        $slug = Str::slug($request->plan_title);
        $plan = Plan::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if plan Dir exists
            if (!Storage::disk('public')->exists('plan')) {
                Storage::disk('public')->makeDirectory('plan');
            }
            // delete old image
            if (Storage::disk('public')->exists('plan/' . $plan->image)) {
                Storage::disk('public')->delete('plan/' . $plan->image);
            }

            $planImage = Image::make($image)->stream();
            Storage::disk('public')->put('plan/' . $imageName, $planImage);
        } else {
            $imageName = $plan->image;
        }

        $plan->plan_title = $request->plan_title;
        $plan->plan_body = $request->plan_body;
        $plan->image = $imageName;
        if (isset($request->status)) {
            $plan->status = true;
        } else {
            $plan->status = false;
        }
        $plan->save();
        Toastr::success('Plan Updated Successfully', 'Success');
        return redirect()->route('admin.plan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plan::find($id);
        if (Storage::disk('public')->exists('plan/' . $plan->image)) {
            Storage::disk('public')->delete('plan/' . $plan->image);
        }

        $plan->delete();
        Toastr::success('plan Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
