@extends('layouts.backend.app')
@section('title','Show Frequently Asked Questions')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.faq.index') }}" class="btn btn-xs btn-danger waves-effect">
            <i class="material-icons">keyboard_return</i>
        </a>
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>FAQ Title :</strong> {{ $faq->faq_title }}
                        </h2>
                    </div>
                    <div class="body">
                        <p><strong>FAQ Body: </strong>{{$faq->faq_body}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Created At: {{ $faq->created_at }}</li>
                        <li class="list-group-item">Updated At: {{ $faq->updated_at }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')

@endpush