@extends('layouts.backend.app')

@section('title','Edit Tag')
@push('css')
@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit Tag
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.tag.update',$tag->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group form-float">
                                <div class="form-line">
                                <input type="text" id="name" name="name" value="{{ $tag->name }}" class="form-control">
                                    <label class="form-label">Tag Name</label>
                                </div>
                            </div>
                            <a href="{{ route('admin.tag.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')

@endpush