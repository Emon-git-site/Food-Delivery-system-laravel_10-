@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sub Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('subcategory.index') }}">Sub Category</a></li>
                            <li class="breadcrumb-item active">All Sub Category</li>
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
                    <h3 class="card-title">SubCategories Table</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_subcategory_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    {{-- delete form --}}
                    <form id="delete_form" action="" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    {{--  new subcategory added modal --}}
    <div class="modal fade" id="add_subcategory_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New SubCategory</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('subcategory.store') }}" method="post" id="add_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="subcategory" class="form-label">Select Category <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="category_id" id="subcategory" required>
                                @foreach ($category as $row)
                                    <option value="{{ $row->id }}"> {{ $row->category_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory_name" class="form-label">SubCategory Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name"
                                placeholder="Subcategory Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control dropify" name="image" data-max-file-size="3M"
                                data-allowed-file-extensions="jpg png jpeg" required />
                        </div>
                        <button type="submit" class="btn btn-success btn-block submit_button">SUBMIT
                            <span class="loading d-none"> .... </span>
                        </button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! new subcategory added modal --}}

    {{-- Update subcategory  modal --}}
    <div class="modal fade" id="update_subcategory_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">SubCategory Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('subcategory/update') }}" method="post" id="update_form">
                        @csrf
                        <input type="hidden" name="subcategory_id" id="subcategory_id">
                        <div class="mb-3">
                            <label for="subcategory_name_update" class="form-label">Category Name <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="category_id" id="subcategory" required>
                                @foreach ($category as $row)
                                    <option value="{{ $row->id }}" data-category-id="{{ $row->id }}">
                                        {{ $row->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory_name_update" class="form-label">SubCategory Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subcategory_name_update"
                                name="subcategory_name_update" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="image_upload" class="form-label">Image Upload <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control dropify" name="image"
                                        data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg" />
                                </div>
                                <div class="col-6">
                                    <label for="old_image" class="form-label">Old Image: </label><br>
                                    <img src="" id="myImage" height="245px" width="210px">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block submit_button">UPDATE
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // toaster message script
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });


        });

        // data tale data show
        function initializeDataTable() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('subcategory.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'subcategory_name',
                        name: 'subcategory_name'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                            var imagePath = 'http://127.0.0.1:8000/' + data;
                            return '<img src="' + imagePath + '" height="35" width="35">';
                        }
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
                $('.submit_button').prop('type', 'button');
                $.ajax({
                    url: url,
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_subcategory_modal').modal('hide');
                        $('.submit_button').prop('type', 'button');
                        toastr.success(response.subcategory_inserted);
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });

            initializeDataTable();
            // show edit modal with data 
            $('body').on('click', '.edit_modal', function() {
                let id = $(this).data('id');
                let url = "{{ url('subcategory/edit') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        let imagePath = 'http://127.0.0.1:8000/' + response.image;
                        $('input[name="subcategory_id"]').val(response.id);
                        $('input[name="subcategory_name_update"]').val(response
                            .subcategory_name);
                        let selected_category = response.category_id;
                        $('#subcategory option').removeAttr('selected');
                        $(`#subcategory option[data-category-id="${selected_category}"]`)
                            .attr('selected', 'selected');
                        $("#myImage").attr("src", imagePath);
                        $('#update_subcategory_modal').modal('show');
                    }
                });
            });
            // update modal submit
            $('#update_form').submit(function(e) {
                e.preventDefault();
                $('.loading').removeClass('d-none');
                let subcategory_id = $('#subcategory_id').val();
                let url = $(this).attr('action') + '/' + subcategory_id;
                let request = $(this).serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $('#update_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#update_subcategory_modal').modal('hide');
                        toastr.success(response.subcategory_update);
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });



            // delete specific Category
            $(document).on('click', '#subcategory_delete', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this post",
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
                        toastr.success(response.subcategory_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();

                    }
                });
            });
        });
    </script>
@endsection
