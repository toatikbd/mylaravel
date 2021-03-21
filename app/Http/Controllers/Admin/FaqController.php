<?php

namespace App\Http\Controllers\Admin;

use App\faq;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = faq::latest()->get();
        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
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
            'faq_title' => 'required',
            'faq_body' => 'required'
        ]);
        $faq = new faq();
        $faq->faq_title = $request->faq_title;
        $faq->slug = Str::slug($request->faq_title);
        $faq->faq_body = $request->faq_body;
        if (isset($request->status)) {
            $faq->status = true;
        } else {
            $faq->status = false;
        }
        $faq->save();
        Toastr::success('FAQ Successfully Saved', 'Success');
        
        return redirect()->route('admin.faq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = faq::find($id);
        return view('admin.faq.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = faq::find($id);
        return view('admin.faq.edit', compact('faq'));
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
        $faq = faq::find($id);
        $faq->faq_title = $request->faq_title;
        $faq->slug = Str::slug($request->faq_title);
        $faq->faq_body = $request->faq_body;
        if (isset($request->status)) {
            $faq->status = true;
        } else {
            $faq->status = false;
        }
        $faq->save();
        Toastr::success('FAQ Successfully Updated', 'Success');

        return redirect()->route('admin.faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        faq::find($id)->delete();
        Toastr::success('FAQ Successfully Delete :)', 'Success');
        return redirect()->back();
    }
}
