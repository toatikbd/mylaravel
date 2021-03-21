@extends('layouts.backend.app')
@section('title','Create New Package')
@push('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .add-list-btn{
        margin-top: 20px;
    }
    /* Remove margins and padding from the list */
    ul {
    margin: 0;
    padding: 0;
    }

    /* Style the list items */
    .package-lists li {
    cursor: pointer;
    position: relative;
    padding: 6px 6px;
    list-style-type: none;
    background: #eee;
    font-size: 16px;
    transition: 0.2s;
    
    /* make the list items unselectable */
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }

    /* Set all odd list items to a different color (zebra-stripes) */
    .package-lists li:nth-child(odd) {
    background: #f9f9f9;
    }

    /* Darker background-color on hover */
    .package-lists  li:hover {
    background: #ddd;
    }



    /* Style the close button */
    .close {
    position: absolute;
    right: 0;
    top: 0;
    padding: 6px 10px;
    }

    .close:hover {
    background-color: #f44336;
    color: white;
    }

</style>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.package.update', $package->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Package
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Package Title</label>
                                    <input type="text" id="title" name="title" value="{{ $package->title }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Sub Title</label>
                                    <input type="text" id="sub_title" name="sub_title" value="{{ $package->sub_title }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">List</label>
                                    <input type="text" id="list" name="list" class="form-control">
                                </div>
                                <div class="col text-center">
                                    <button class="btn btn-primary add-list-btn waves-effect" onclick="newElement()" type="button"><i class="material-icons">add_box</i></button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="footer">
                            <ul id="package_list" class="package-lists sortable">
                                @foreach(unserialize($package->list) as $key => $item)
                                <li class="list-item">{{ $item }}<input type="hidden" name="list[]" value="{{ $item }}"></li>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="input-group form-float">
                                <span class="input-group-addon">৳ Price</span>
                                <div class="form-line">
                                    <input type="text" id="price" name="price" value="{{ $package->price }}" class="form-control date">
                                </div>
                                <span class="input-group-addon">.00</span>
                            </div>
                            <div class="form-group form-float">
                                <input type="checkbox" id="publish" name="status" value="1" {{ $package->status == true ? 'checked' : '' }} class="filled-in">
                                <label class="form-label" for="publish">Publish</label>
                            </div>
                            <a href="{{ route('admin.package.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    // Create a "close" button and append it to each list item
    var myNodelist = document.getElementsByClassName("list-item");
    var i;
    for (i = 0; i < myNodelist.length; i++) {
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    myNodelist[i].appendChild(span);
    }

    // Click on a close button to hide the current list item
    var close = document.getElementsByClassName("close");
    var i;
    for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
        this.parentElement.remove();
    }
    }


    // Create a new list item when clicking on the "Add" button
    function newElement() {
    var li = document.createElement("li");
    li.className = "list-item";
    var input = document.createElement("input");
    var inputValue = document.getElementById("list").value;
    var t = document.createTextNode(inputValue);
    input.value = inputValue;
    input.name = "list[]";
    input.hidden = true;
    li.appendChild(t);
    li.appendChild(input);
    if (inputValue === '') {
        alert("You must write something!");
    } else {
        document.getElementById("package_list").appendChild(li);
    }
    document.getElementById("list").value = "";

    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    li.appendChild(span);

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
            this.parentElement.remove();
        }
    }
    }

    // New list script
    $( function() {
        $( ".sortable" ).sortable();
        $( ".sortable" ).disableSelection();
    } );
</script>
@endpush