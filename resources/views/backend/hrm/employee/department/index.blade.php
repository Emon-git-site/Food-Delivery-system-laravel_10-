@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Department</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.hrm.employee.department.index') }}">Department</a></li>
                            <li class="breadcrumb-item active">All Department</li>
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
                    <h3 class="card-title">Department List </h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_department_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Department Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    {{-- department item delete form --}}
                    <form id="delete_form" action="" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    {{--  new department added modal --}}
    <div class="modal fade" id="add_department_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Department</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.hrm.employee.department.store') }}" method="post" id="add_form">
                        @csrf
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Department Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="department_name" 
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
    {{-- ! new floor added modal --}}

    {{-- Update department  modal --}}
    <div class="modal fade" id="update_department_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Department Name Update</h4>
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
    {{-- ! Update department  modal --}}
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
                ajax: "{{ route('admin.hrm.employee.department.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            });
        }


        // modal designation Submit
        $(document).ready(function() {
            initializeDataTable();
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
                        $('#add_department_modal').modal('hide');
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                         if(response.department_create) {
                            toastr.success(response.department_create);
                        }
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });

            initializeDataTable();

            // Event handler for opening the edit modal
            $('body').on('click', '.edit_modal_btn', function() {
                let department_id = $(this).data('id');
                let url = "{{ url('admin/hrm/employee/department/edit') }}/" + department_id;

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('#update_part').html(response);
                    }
                });
            });

            // delete specific designation
            $(document).on('click', '#department_delete', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this Department",
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
                        toastr.success(response.department_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();

                    }
                });
            });
        });
    </script>
@endsection
