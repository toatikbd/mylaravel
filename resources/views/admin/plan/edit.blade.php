@extends('layouts.backend.app')
@section('title','Edit Plan')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.plan.update', $plan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Plan
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Plan Title</label>
                                    <input type="text" id="plan_title" name="plan_title" value="{{ $plan->plan_title }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Plan Body</label>
                                    <textarea name="plan_body" id="plan_body" cols="30" rows="5" class="form-control">{{ $plan->plan_body }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="image">Featured Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <input type="checkbox" id="publish" name="status" value="1" {{ $plan->status == true ? 'checked' : '' }} class="filled-in">
                                <label class="form-label" for="publish">Publish</label>
                            </div>
                            <a href="{{ route('admin.plan.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
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