<?php

namespace App\Http\Controllers\Admin;

use App\Designation;
use App\Http\Controllers\Controller;
use App\Team;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::latest()->get();
        return view('admin.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view =  view('admin.team.create');
        $view->with('designation_list', Designation::orderBy('order_priority','asc')->get());
        return $view;
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
            'designation_id' => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if (isset($image)) {
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if team Dir exists
            if (!Storage::disk('public')->exists('team')) {
                Storage::disk('public')->makeDirectory('team');
            }
            $teamImage = Image::make($image)->crop(300, 300)->stream();
            Storage::disk('public')->put('team/' . $imageName, $teamImage);
        } else {
            $imageName = 'default.png';
        }

        $team = new Team();
        $team->name = $request->name;
        $team->designation_id = $request->designation_id;
        $team->image = $imageName;
        if (isset($request->status)) {
            $team->status = true;
        } else {
            $team->status = false;
        }
        $team->save();
        Toastr::success('team Successfully Saved', 'Success');
        return redirect()->route('admin.team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $team = Team::find($id);
        // return view('admin.team.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('admin.team.edit', compact('team'));
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
            'designation_id' => 'required',
            'image' =>  'image|mimes:jpeg,png,jpg,svg'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);
        $team = Team::find($id);
        if (isset($image)) {
            // make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // Check if team Dir exists
            if (!Storage::disk('public')->exists('team')) {
                Storage::disk('public')->makeDirectory('team');
            }
            // delete old image
            if (Storage::disk('public')->exists('team/' . $team->image)) {
                Storage::disk('public')->delete('team/' . $team->image);
            }

            $teamImage = Image::make($image)->crop(150, 150)->stream();
            Storage::disk('public')->put('team/' . $imageName, $teamImage);
        } else {
            $imageName = $team->image;
        }

        $team->name = $request->name;
        $team->designation_id = $request->designation_id;
        $team->image = $imageName;
        if (isset($request->status)) {
            $team->status = true;
        } else {
            $team->status = false;
        }
        $team->save();
        Toastr::success('Team Member info Updated Successfully', 'Success');
        return redirect()->route('admin.team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        if (Storage::disk('public')->exists('team/' . $team->image)) {
            Storage::disk('public')->delete('team/' . $team->image);
        }

        $team->delete();
        Toastr::success('Team Member Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
