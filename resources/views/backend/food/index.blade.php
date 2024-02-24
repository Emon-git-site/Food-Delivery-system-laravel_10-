@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Food Item</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.food.index') }}">Food Item</a></li>
                            <li class="breadcrumb-item active">All Food Item</li>
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
                    <h3 class="card-title">Food Item List</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_food_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <br>
                <div class="ml-4 mr-4">
                    <div class="row">
                        <div class="col-6">
                            <select class="form-control submit_table" name="subcategory_id" id="subcategory_id">
                                <option value="">All</option>
                                @foreach ($categories as $category)
                                @foreach ($category->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                @endforeach
                            @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-control submit_table" name="food_status" id="food_status">
                                <option value="">All</option>
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Status</th>
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

    {{--  new food  added modal --}}
    <div class="modal fade" id="add_food_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Food Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.food.store') }}" method="post" id="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="expense_type" class="form-label">Select Category <span
                                    class="text-danger">*</span></label>
                            <select name="subcategory_id" class="form-control">
                                <option value="">Select One</option>
                                @foreach ($categories as $category)
                                    <option disabled class="text-primary">{{ $category->category_name }}</option>
                                    @foreach ($category->subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}"> --{{ $subcategory->subcategory_name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="food_name" class="form-label">Food Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="food_name" name="food_name"
                                placeholder="Food Name" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="food_price" class="form-label">Food price <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="food_price" name="food_price"
                                        placeholder="Food Price" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="food_discournt_price" class="form-label">Food Discount Price </label>
                                    <input type="text" class="form-control" id="food_discournt_price" name="food_discournt_price"
                                        placeholder="Food Discount Price" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="food_description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="food_description" class="form-control" cols="30" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="food_image" class="form-label">Food Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control dropify" name="food_image" data-max-file-size="3M"
                                data-allowed-file-extensions="jpg png jpeg" required />
                        </div>
                        <div class="mb-3">
                            <label for="food_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="food_status" class="form-control" required>
                                <option value="1">Publish</option>
                                <option value="0">Unpublish</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="top" class="form-label">Top Recipes <span class="text-danger">*</span></label>
                            <select name="top" class="form-control" required>
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
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
    ! new food added modal

    {{-- Update food  modal --}}
    <div class="modal fade" id="update_food_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Food Item Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="update_part">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! Update food  modal --}}
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
                ajax: {
                    url: "{{ route('admin.food.index') }}",
                    data: function(e){
                        e.subcategory_id = $('#subcategory_id').val();
                        e.food_status = $('#food_status').val();
                    }
                },
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image',
                        render: function(data, type, full, meta) {
                            var imagePath = 'http://127.0.0.1:8000/' + data;
                            return '<img src="' + imagePath + '" height="35" width="35">';
                        }
                    },
                    {
                        data: 'price',
                        image: 'price'
                    },
                    {
                        data: 'status',
                        image: 'status'
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
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData:false,
                    success: function(response) {
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_food_modal').modal('hide');
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        } 
                        if(response.food_add) {
                            toastr.success(response.food_add);
                        }
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });
        });
        // edit request send
        $(document).ready(function() {
            $('body').on('click', '.edit_modal_btn', function() {
                let id = $(this).data('id');
                let url = "{{ url('admin/food/edit') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('#update_part').html(response);

                    }
                });
            });
        });



        // delete specific Category
        $(document).ready(function() {
            $(document).on('click', '#food_delete', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this Food Item",
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
                        toastr.success(response.food_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();

                    }
                });
            });
        });
            // submit_table class call for every change
    $(document).on('change', '.submit_table', function(){
        initializeDataTable();
    });
    </script>
@endsection
