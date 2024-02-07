@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                            <li class="breadcrumb-item active">All Category</li>
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
                    <h3 class="card-title">Categories Table</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_category_modal"><i class="fa fa-plus"></i> Add New</button>
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
    <div class="modal fade" id="add_category_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('category.store') }}" method="post" id="add_form">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
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

    {{-- Update category  modal --}}
    <div class="modal fade" id="update_category_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Category Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" method="post" id="update_form">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="category_id">
                            <label for="category_name_update" class="form-label">Category Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="category_name_update" name="category_name_update"
                                required>
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
                ajax: "{{ route('category.categoryShow') }}",
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
                        $('#add_category_modal').modal('hide');
                        toastr.success(response.add_new_category);
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
                let url = "{{ url('category/edit') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                            $('input[name="category_id"]').val(response.id);
                            $('input[name="category_name_update"]').val(response
                                .category_name);
                    }
                });
            });
        });

        $(document).ready(function() {
            // update modal Submit
            $('#update_form').submit(function(e) {
                e.preventDefault();
                $('.loading').removeClass('d-none');
                let category_id = $('input[name="category_id"]').val();
                let url = "{{ url('category/update') }}/" + category_id;
                let data = {
                    'category_name': $('#category_name_update').val()
                };
                console.log(data);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    success: function(response) {
                        $('#update_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#update_category_modal').modal('hide');
                        toastr.success(response.category_update);
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });
        });
    
    // delete specific Category
    $(document).ready(function(){
        $(document).on('click', '#category_delete', function(e){
            e.preventDefault();
            let url = $(this).attr('href');
            // Set the form action attribute before submitting
            $('#delete_form').attr('action', url);          
              swal({
                    title: "Are you sure to Delete this post",
                    text: "You will not be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete)=>{
                    if(willDelete){
                        $('#delete_form').submit();
                    }
                });
        });
        // data passed through here
        $('#delete_form').submit(function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            let request = $(this).serialize();
            $.ajax({
                url: url,
                data: request,
                success: function(response){
                    toastr.success(response.category_delete);
                    $('#delete_form')[0].reset(); 
                    initializeDataTable();

                }
            });
        });
    });
    </script>
@endsection
