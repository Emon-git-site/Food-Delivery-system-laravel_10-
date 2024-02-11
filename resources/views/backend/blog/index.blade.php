@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Blog</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
                            <li class="breadcrumb-item active">All Blog</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if (session()->has('errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br />
        @endif
        <!-- /.content-header -->
        <!-- /.content-header -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">Blog Table</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_blog_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Created Date</th>
                                <th>Category</th>
                                <th>Title</th>
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

    {{--  new blog added modal --}}
    <div class="modal fade" id="add_blog_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Blog</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.blog.store') }}" method="post" id="add_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="blogCategory" class="form-label">Select Blog Category <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="blogcategory_id" id="blogCategory" required>
                                @foreach ($blogcategory as $row)
                                    <option value="{{ $row->id }}"> {{ $row->category_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="blog_title" class="form-label">Blog Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="blog_title" name="blog_title"
                                placeholder="Blog Title" required>
                        </div>
                        <div class="mb-3">
                            <label for="blog_description" class="form-label">Blog Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control text_area" name="blog_description" cols="15" rows="5" required></textarea>
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

    {{-- Update blog  modal --}}
    <div class="modal fade" id="update_blog_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Blog Category Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/blog/update') }}" method="post" id="update_form">
                        @csrf
                        <input type="hidden" name="blog_id" id="blog_id">
                        <div class="mb-3">
                            <label for="blogcategory" class="form-label">Blog Category Name <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="blogcategory_id" id="blogcategory_id" required>
                                @foreach ($blogcategory as $row)
                                    <option value="{{ $row->id }}" blogcategory_id="{{ $row->id }}">
                                        {{ $row->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="blog_title_update" class="form-label">Blog Title <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="blog_title_update" name="blog_title_update"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="blog_description_update" class="form-label">Blog Description <span
                                    class="text-danger">*</span></label>
                            <div name="blog_description_update" class="form-control text_area" cols="20"
                                rows="10"></div>
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
        // data tale data show
        function initializeDataTable() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.blog.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'created_date',
                        name: 'created_date'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'title',
                        name: 'title'
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

        // modal addForm Submit
        $(document).ready(function() {
            initializeDataTable();
            $('#add_form').submit(function(e) {
                e.preventDefault();
                $('.loading').removeClass('d-none');
                let url = $(this).attr('action');
                $.ajax({
                    url: url,
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_blog_modal').modal('hide');
                        if (response.status == 200) {
                            toastr.success(response.new_blog_inserted);
                        }
                        if (response.status == 400) {
                            toastr.error(response.validation_failed);
                        }
                        initializeDataTable();
                        $('#example1').DataTable().ajax.reload();
                    }
                })
            });

            initializeDataTable();

            // Event handler for opening the edit modal
            $('body').on('click', '.edit_modal_btn', function() {
                let blog_id = $(this).data('id');
                let url = "{{ url('admin/blog/edit') }}/" + blog_id;

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        let imagePath = 'http://127.0.0.1:8000/' + response.image;
                        console.log(response.description);
                        $('input[name="blog_id"]').val(response.id);
                        $('input[name="blog_title_update"]').val(response.title);
                        document.querySelector('div[name="blog_description_update"]')
                            .innerHTML = response.description;
                        let selected_category = response.category_id;
                        $('#blogcategory option').removeAttr('selected');
                        $(`#blogcategory_id option[blogcategory_id="${selected_category}"]`)
                            .attr('selected', 'selected');
                        $("#myImage").attr("src", imagePath);
                        $('#update_blog_modal').modal('show');
                    }
                });
            });
            // Event handler for submitting the update form
            $('#update_form').submit(function(e) {
                e.preventDefault();
                $('.loading').removeClass('d-none');

                let blog_id = $('#blog_id').val();
                let url = "{{ url('admin/blog/update') }}/" + blog_id;
                let request = $(this).serialize();

                $.ajax({
                    url: url,
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        // Reset the form and hide the modal
                        $('#update_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#update_blog_modal').modal('hide');

                        toastr.success(response.blog_updated);
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                });
            });



            // delete specific Category
            $(document).on('click', '#blog_delete', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this blog",
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
                        toastr.success(response.blog_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();

                    }
                });
            });
        });
    </script>
@endsection
