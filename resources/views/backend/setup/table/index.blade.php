@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Table</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.table.index') }}">Table</a></li>
                            <li class="breadcrumb-item active">All Table</li>
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
                    <h3 class="card-title">Table List </h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_table_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Floor Name</th>
                                <th>Table Code</th>
                                <th>Table Sit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    {{-- floor item delete form --}}
                    <form id="delete_form" action="" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    {{--  new table added modal --}}
    <div class="modal fade" id="add_table_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Table</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.table.store') }}" method="post" id="add_form">
                        @csrf
                        <div class="mb-3">
                            <label for="floor_name" class="form-label">Floor Name <span
                                    class="text-danger">*</span></label>
                                    <select class="form-control" name="floor_id" required>
                                        @foreach ($floor as $row)
                                            <option value="{{ $row->id }}">{{ $row->floor_name }}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="mb-3">
                            <label for="table_code" class="form-label">Table Code <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="table_code" name="table_code" placeholder="Enter table code" required>
                        </div>
                        <div class="mb-3">
                            <label for="table_sit" class="form-label">Table Sit <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="table_sit" name="table_sit" placeholder="1:1 OR 2:2" required>
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
    {{-- ! new table added modal --}}

    {{-- Update table  modal --}}
    <div class="modal fade" id="update_table_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Table Update</h4>
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
    {{-- ! Update table  modal --}}
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
                ajax: "{{ route('admin.table.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'floor_name',
                        name: 'floor_name'
                    },
                    {
                        data: 'table_code',
                        name: 'table_code'
                    },
                    {
                        data: 'table_sit',
                        name: 'table_sit'
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
                        console.log(response);
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_table_modal').modal('hide');
                        if (response.status == 201) {
                            toastr.success(response.tableName_add);
                        }
                        if (response.status == 401) {
                            toastr.error(response.tableName_validation_failed);
                        }
                        initializeDataTable();
                        $('#example1').DataTable().ajax.reload();
                    }
                })
            });

            initializeDataTable();

            // Event handler for opening the edit modal
            $('body').on('click', '.edit_modal_btn', function() {
                let table_id = $(this).data('id');
                let url = "{{ url('admin/table/edit') }}/" + table_id;

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                      $('#update_part').html(response);
                    }
                });
            });

            // delete specific Floor
            $(document).on('click', '#table_delete', function(e) {
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
                        toastr.success(response.table_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();
                    }
                });
            });
        });
    </script>
@endsection
