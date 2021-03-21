@extends('layouts.frontend.app')

@section('title', 'Our Team Members')

@push('css')
    <style>
        
    </style>
@endpush

@section('content')
    
    <!-- Page Title -->
<section class="page-title-wrap" data-bg-img="{{ url('assets/frontend/img/hills.jpg') }}" data-rjs="2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title" data-animate="fadeInUp" data-delay="1.2">
                        <h2>Our Teams</h2>
                        <ul class="list-unstyled m-0 d-flex">
                            <li><a href="#">Our Teams Member Information</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Page Title -->
    
    <!-- team info -->
    <section class="pt-120 pb-65">
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <tbody>
                            @foreach($teams as $key => $team)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ Str::limit($team->name, 20) }}</td>
                                    <td>{{ Str::limit($team->designation_id, 15) }}</td>
                                    <td>
                                        <img class="img-responsive thumbnail" width="50" height="auto" src="{{ url('storage/team/'. $team->image)  }}" alt="{{ $team->name }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </section>
    <!-- End team info -->
    
@endsection

@push('js') 
@endpush