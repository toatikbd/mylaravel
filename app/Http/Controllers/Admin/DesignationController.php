<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = view('admin.designation.index');
        $view->with('designation_list', Designation::latest()->get());
        return $view;
    }

    /**fdfdf
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.designation.create');
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
        $this->validate($request,[
            'title'=>'required',
            'order_priority'=>'required|integer|unique:designations'
        ]);
        $designation = new Designation();
        $designation->fill($request->all());
        $designation->save();
        return redirect()->route('admin.designation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        $view = view('admin.designation.show');
        $view->with('designation', $designation);
        return $view;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        $view = view('admin.designation.edit');
        $view->with('designation', $designation);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $this->validate($request, [
            'title' => 'required',
            'order_priority'=>'required|integer|unique:designations'
        ]);
        $designation->fill($request->all());
        $designation->update();
        return redirect()->route('admin.designation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('admin.designation.index');
    }
}
