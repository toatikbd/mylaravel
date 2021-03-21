@extends('layouts.backend.app')
@section('title','Show Post')
@push('css')

@endpush
@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.post.index') }}" class="btn btn-xs btn-danger waves-effect">
            <i class="material-icons">keyboard_return</i>
        </a>
        @if($post->is_approved == false)
            <button type="button" class="btn btn-xs btn-warning waves-effect pull-right" onclick="pendingPost({{ $post->id }})"> 
                <i class="material-icons">trending_up</i>
                <span>Approve</span>
            </button>
            <form method="POST" action="{{ route('admin.post.approve', $post->id) }}" id="approval-form" style="display:none">
                @csrf
                @method('put')
            </form>
        @else
            <button type="button" class="btn btn-xs btn-success pull-right" disabled> 
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
        @endif
        <br><br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ $post->title }}
                            <small> Posted By <strong><a href="">{{ $post->user->name }}</a></strong>
                                on {{ $post->created_at->toFormattedDateString() }}
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            Category
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->categories as $key => $category)
                    <span class="label bg-cyan">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-green">
                        <h2>
                            Tags
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->tags as $key => $tag)
                    <span class="label bg-green">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                            Thumbnail
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ url('storage/post/'. $post->image)  }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
@endsection

@push('js')
    <!-- Sweetalert2 -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.all.min.js"></script> --}}
    <script src="{{ asset('assets/backend/js/sweetalert2.all.min.js') }}"></script>

    <script type="text/javascript">
        function pendingPost(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You went to approve this Post!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form').submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'This post remain pending :(',
                    'info'
                    )
                }
            })
        }
    </script>
@endpush