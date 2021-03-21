@extends('layouts.backend.app')
@section('title','Show Review')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.review.index') }}" class="btn btn-xs btn-danger waves-effect">
            <i class="material-icons">keyboard_return</i>
        </a>
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>Author Name :</strong> {{ $review->name }}
                        </h2>
                    </div>
                    <div class="body">
                        <p><strong>Review Count: </strong>{{$review->review_count}}</p>
                        <p><strong>Job Title :</strong> {{ $review->job_title }}</p>
                        <p><strong>Review Content :</strong> {{ $review->review_text }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Created At: {{ $review->created_at }}</li>
                        <li class="list-group-item">Updated At: {{ $review->updated_at }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                
                <div class="card">
                    <div class="header bg-green">
                        <h2>
                            Author Photo
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ url('storage/review/'. $review->image)  }}" alt="{{ $review->name }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')

@endpush