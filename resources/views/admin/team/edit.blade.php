@extends('layouts.backend.app')
@section('title','Edit Team Member info')
@push('css')
    <style>
        
  
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Team Member info
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Member Name</label>
                                <input type="text" id="name" name="name" value="{{ $team->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <select class="form-control show-tick" name="designation_id">
                                    <option>-- Select Designation--</option>
                                    @foreach ($designation_list as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="image">Member Photo</label>
                                    <input type="file" name="image" class="form-control">
                                    <img class="img-responsive thumbnail" width="100" height="auto" src="{{ url('storage/team/'. $team->image)  }}" alt="{{ $team->name }}">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <input type="checkbox" id="publish" name="status" value="1" {{ $team->status == true ? 'checked' : '' }} class="filled-in">
                                <label class="form-label" for="publish">Publish</label>
                            </div>
                            <a href="{{ route('admin.team.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
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

<script>
       
    </script>
@endpush