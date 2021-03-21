@extends('layouts.backend.app')

@section('title','All Comments')
@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Comments
                                {{-- <span class="badge bg-blue">{{ $posts->comments->count() }}</span> --}}
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Comments Info</th>
                                            <th>Post Info</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Comments Info</th>
                                            <th>Post Info</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($posts as $key => $post)
                                            @foreach($post->comments as $comment)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <div class="media">
                                                            <div class="media-left">
                                                                <a href="http://">
                                                                    <img src="{{ url('storage/profile/'. $comment->user->image) }}" class="dedia-object" width="64" height="64" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h4>
                                                                <p>{{ Str::limit($comment->comment, '40') }}</p>
                                                                <a target="_blank" href="{{ route('post.details',$comment->post->slug.'#comments') }}">Reply</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <div class="media-right">
                                                                <a target="_blank" href="{{ route('post.details',$comment->post->slug) }}">
                                                                    <img class="media-object" src="{{ url('storage/post/'.$comment->post->image) }}" class="dedia-object" width="64" height="64" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <a target="_blank" href="{{ route('post.details',$comment->post->slug) }}">
                                                                    <h4 class="media-heading">{{ Str::limit($comment->post->title,'40') }}</h4>
                                                                </a>
                                                                <p>by <strong>{{ $comment->post->user->name }}</strong></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger waves-effect" onclick="deleteComment({{ $comment->id }})">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                        <form id="delete-form-{{ $comment->id }}" method="POST" action="{{ route('author.comment.destroy',$comment->id) }}" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>


    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <!-- Sweetalert2 -->
    <script src="{{ asset('assets/backend/js/sweetalert2.all.min.js') }}"></script>

    <script type="text/javascript">
        function deleteComment(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your Data is safe :)',
                    'error'
                    )
                }
            })
        }

    </script>

@endpush