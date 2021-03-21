@extends('layouts.backend.app')
@section('title','Edit Slider')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Slider
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Slider Title</label>
                                    <input type="text" id="title" name="title" value="{{ $slider->title }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Sub Title</label>
                                    <input type="text" id="sub_title" name="sub_title" value="{{ $slider->sub_title }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Link</label>
                                    <input type="text" id="link" name="link" value="{{ $slider->link }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="image">Featured Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="form-group form-float">
                                <input type="checkbox" id="publish" name="status" value="1" {{ $slider->status == true ? 'checked' : '' }} class="filled-in">
                                <label class="form-label" for="publish">Publish</label>
                            </div>
                            <a href="{{ route('admin.slider.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')

@endpush