@extends('layouts.backend.app')
@section('title','Show Plan')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.plan.index') }}" class="btn btn-xs btn-danger waves-effect">
            <i class="material-icons">keyboard_return</i>
        </a>
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>Plan Title :</strong> {{ $plan->plan_title }}
                        </h2>
                    </div>
                    <div class="body">
                        <p><strong>Plan Body: </strong>{{$plan->plan_body}}</p>
                        <strong>Plan Image: </strong>
                        <img class="img-responsive thumbnail" width="200" height="auto" src="{{ url('storage/plan/'. $plan->image)  }}" alt="{{ $plan->plan_title }}">
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Created At: {{ $plan->created_at }}</li>
                        <li class="list-group-item">Updated At: {{ $plan->updated_at }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')

@endpush