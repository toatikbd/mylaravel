@extends('layouts.backend.app')
@section('title','Show Slider')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.slider.index') }}" class="btn btn-xs btn-danger waves-effect">
            <i class="material-icons">keyboard_return</i>
        </a>
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>Title :</strong> {{ $slider->title }}
                        </h2>
                    </div>
                    <div class="body">
                        <p><strong>Sub Title :</strong> {{ $slider->sub_title }}</p>
                        <p><strong>Link : </strong><a href="{{ $slider->link }}" class="btn btn-primary waves-effect" target="_blank">{{ $slider->link }}</a> </p>      
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                            Slider Thumbnail
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ url('storage/slider/'. $slider->image)  }}" alt="{{ $slider->title }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')

@endpush