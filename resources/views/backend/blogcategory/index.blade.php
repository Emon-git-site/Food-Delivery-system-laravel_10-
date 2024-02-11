@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Blog Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.blogCategory.index') }}">Blog Category</a>
                            </li>
                            <li class="breadcrumb-item active">All Blog Category</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- /.content-header -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">Blog Categories Table</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_blogcategory_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category</th>
                                <th>Category Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <form id="delete_form" action="" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    {{--  new category added modal --}}
    <div class="modal fade" id="add_blogcategory_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Blog Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.blogCategory.store') }}" method="post" id="add_form">
                        @csrf
                        <div class="mb-3">
                            <label for="blogcategory_name" class="form-label">Blog Category Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="blogcategory_name" name="blogcategory_name"
                                required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">SUBMIT
                            <span class="loading d-none"> .... </span>
                        </button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! new category added modal --}}

    {{-- Update blog category  modal --}}
    <div class="modal fade" id="update_blogcategory_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Blog Category Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" method="post" id="update_form">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="blogcategory_id">
                            <label for="blogcategory_name_update" class="form-label">Category Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="blogcategory_name_update"
                                name="blogcategory_name_update" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">UPDATE
                            <span class="loading d-none"> .... </span> </button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! Update category  modal --}}
@endsection
@section('script')
    <script type="text/javascript">

        // data tale data show
        function initializeDataTable() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.blogCategory.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'category_slug',
                        name: 'category_slug'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            });
        }

        $(document).ready(function() {
            initializeDataTable();

            // modal addForm Submit
            $('#add_form').submit(function(e) {
                e.preventDefault();
                $('.loading').removeClass('d-none');
                let url = $(this).attr('action');
                let request = $(this).serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: request,
                    success: function(response) {
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_blogcategory_modal').modal('hide');
                        toastr.success(response.add_new_blogcategory);
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });
        });

        // edit request send
        $(document).ready(function() {
            $('body').on('click', '.edit_modal', function() {
                let id = $(this).data('id');
                let url = "{{ url('admin/blogCategory/edit') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('input[name="blogcategory_id"]').val(response.id);
                        $('input[name="blogcategory_name_update"]').val(response
                            .category_name);
                    }
                });
            });


            // update Blog Category modal Submit
            $(document).ready(function() {
                $('#update_form').submit(function(e) {
                    e.preventDefault();
                    $('.loading').removeClass('d-none');
                    let blogcategory_id = $('input[name="blogcategory_id"]').val();
                    let url = "{{ url('admin/blogCategory/update') }}/" + blogcategory_id;
                    let data = {
                        'category_name': $('#blogcategory_name_update').val()
                    };
                    console.log(data);
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: data,
                        success: function(response) {
                            $('#update_form')[0].reset();
                            $('.loading').addClass('d-none');
                            $('#update_blogcategory_modal').modal('hide');
                            toastr.success(response.blogcategory_update);
                            $('#example1').DataTable().ajax.reload();
                            initializeDataTable();
                        }
                    })
                });
            });
        });

        // delete specific Category
        $(document).ready(function() {
            $(document).on('click', '#blogCategory_delete', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this BlogCategory",
                        text: "You will not be able to revert this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('#delete_form').submit();
                        }
                    });
            });
            // data passed through here
            $('#delete_form').submit(function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let request = $(this).serialize();
                $.ajax({
                    url: url,
                    data: request,
                    success: function(response) {
                        toastr.success(response.blogcategory_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();

                    }
                });
            });
        });
    </script>
@endsection
