@extends('layouts.backend.app')

@section('title','Frequently Asked Questions')
@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
            <div class="block-header">
                <a href="{{ route('admin.faq.create') }}" class="btn btn-primary waves-effect">
                    <i class="material-icons">add</i>
                    <span>Create New</span>
                </a>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All FAQs
                                <span class="badge bg-blue">{{ $faqs->count() }}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>FAQ Title</th>
                                            <th>FAQ Body</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>FAQ Title</th>
                                            <th>FAQ Body</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($faqs as $key => $faq)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ Str::limit($faq->faq_title, 20) }}</td>
                                                <td>{{ Str::limit($faq->faq_body, 30) }}</td>
                                                <td>
                                                    @if($faq->status == true)
                                                        <span class="badge bg-blue">Published</span>
                                                    @else
                                                        <span class="badge bg-pink">Unpublish</span>
                                                    @endif
                                                </td>
                                                <td>{{ $faq->created_at }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.faq.show', $faq->id) }}" class="btn  btn-xs btn-primary waves-effect">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                    <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn  btn-xs btn-primary waves-effect">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <button class="btn  btn-xs btn-danger waves-effect" type="button" onclick="delectFaq({{ $faq->id }})">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                    <form id="delete-form-{{ $faq->id }}" action="{{ route('admin.faq.destroy',$faq->id) }}" method="POST" style="display:none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
        function delectFaq(id){
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