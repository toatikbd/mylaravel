<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Package;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::latest()->get();
        return view('admin.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|unique:packages',
            'sub_title' => 'required',
            'list' => 'required',
            'price' => 'required',
        ]);
        $package = new Package();
        $package->title = $request->title;
        $package->sub_title = $request->sub_title;
        $package->list = serialize($request->list);
        $package->price = $request->price;
        if (isset($request->status)) {
            $package->status = true;
        } else {
            $package->status = false;
        }
        $package->save();
        Toastr::success('Package Successfully Saved', 'Success');
        return redirect()->route('admin.package.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.package.show', compact('package'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        return view('admin.package.edit', compact('package'));
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
        $package = Package::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|unique:packages,title,'. $package->id,
            'sub_title' => 'required',
            'list' => 'required',
            'price' => 'required',
        ]);
        $package->title = $request->title;
        $package->sub_title = $request->sub_title;
        $package->list = serialize($request->list);
        $package->price = $request->price;
        if (isset($request->status)) {
            $package->status = true;
        } else {
            $package->status = false;
        }
        $package->update();
        Toastr::success('Package Successfully Updated', 'Success');
        return redirect()->route('admin.package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Package::find($id)->delete();
        Toastr::success('Package Successfully Delete :)', 'Success');
        return redirect()->back();
    }
}
