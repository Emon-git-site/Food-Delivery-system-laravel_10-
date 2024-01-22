@extends('layouts.app')
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
                    {{-- {{ route('category.store') }} --}}
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="category_name" name="add_modal_category_en"
                                required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">UPDATE</button>
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
        // Define the DataTable initialization function
        function initializeDataTable() {
            console.log('Initializing DataTable...');
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
                        data: 'action',
                        name: 'action'
                    },
                ],
            });
        }

        $(document).ready(function() {
            // Call the function to initialize DataTable when the document is ready
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
                    success: function() {
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_category_modal').modal('hide');
                        toastr.success('Category added successfully');
                        // Initialize DataTable after successful form submission
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });
        });

        $(document).ready(function() {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });


		});

        // edit request send
        $('body').on('click', '.edit_modal', function(){
            alert('edit modal');
        });

    </script>
@endsection
