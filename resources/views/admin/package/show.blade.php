@extends('layouts.backend.app')
@section('title','Show Package')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.package.index') }}" class="btn btn-xs btn-danger waves-effect">
            <i class="material-icons">keyboard_return</i>
        </a>
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>Package Title :</strong> {{ $package->title }}
                            <strong>Sub Title: </strong>{{$package->sub_title}}
                             <strong>Package Price :</strong> {{ $package->price }}
                        </h2>
                    </div>
                    <div class="body">
                        <ul class="list-group list-group-flush" style="margin-top: 5px;">
                            <label>Package Lists:</label>
                            @foreach(unserialize($package->list) as $key => $item)
                            <li class="list-group-item">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Created At: {{ $package->created_at }}</li>
                        <li class="list-group-item">Updated At: {{ $package->updated_at }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')

@endpush