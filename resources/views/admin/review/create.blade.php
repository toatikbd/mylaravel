@extends('layouts.backend.app')
@section('title','Create New Review')
@push('css')
    <style>
        .rate-base-layer
        {
            color: #aaa;
        }
        .rate-hover-layer
        {
            color: orange;
        }
        .rateingbox
        {
            font-size: 35px;
        }
        .rateingbox .rate-hover-layer
        {
            color: pink;
        }
        .rateingbox .rate-select-layer
        {
            color: red;
        }
  
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.review.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Create New Review
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Author Name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Job Title</label>
                                    <input type="text" id="job_title" name="job_title" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Review Text</label>
                                    <textarea name="review_text" id="review_text" cols="30" rows="5" class="form-control"></textarea>
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
                                    <label for="image">Author Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label>Review Out of 5 to ?</label>
                                    <div class="rateingbox"></div>
                                    <input id="rateBox" name="review_count" type="text" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <input type="checkbox" id="publish" name="status" value="1" class="filled-in">
                                <label class="form-label" for="publish">Publish</label>
                            </div>
                            <a href="{{ route('admin.review.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')
<script src="{{ asset('assets/backend/plugins/rater-master/rater.min.js') }}"></script>

<script>
        $(document).ready(function(){
            var options = {
                max_value: 5,
                step_size: 1,
                selected_symbol_type: 'hearts',
                initial_value: 0,
                update_input_field_name: $("#rateBox"),
            }


            $(".rateingbox").rate(options);

            $(".rateingbox").on("change", function(ev, data){
                console.log(data.from, data.to);
            });

            $(".rateingbox").on("updateError", function(ev, jxhr, msg, err){
                console.log("This is a custom error event");
            });

            $(".rateingbox").rate("setAdditionalData", {id: 42});
            $(".rateingbox").on("updateSuccess", function(ev, data){
                console.log(data);
            }); 
        });
    </script>

@endpush