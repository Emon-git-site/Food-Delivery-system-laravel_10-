@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.hrm.employee.employee.index') }}">Employee</a></li>
                            <li class="breadcrumb-item active">All Employee</li>
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
                    <h3 class="card-title">Employee List</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_employee_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Image</th>
                                <th>Salary</th>
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

    {{--  new employee  added modal --}}
    <div class="modal fade" id="add_employee_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.hrm.employee.employee.store') }}" method="post" id="add_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="employee_id" class="form-label">Employee ID <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="employee_id"
                                        placeholder="Enter Employee Id" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="employee_name" class="form-label">Employee Name<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" class="form-control"  name="name"
                                        placeholder="Enter Employee Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="department" class="form-label">Department <span
                                            class="text-danger">*</span></label>
                                    <select name="department_id" class="form-control" required>
                                        <option value="">Choose One</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="designation" class="form-label">Designation <span
                                            class="text-danger">*</span></label>
                                    <select name="designation_id" class="form-control" required>
                                        <option value="">Choose One</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->designation_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="employee_number" class="form-label">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="Enter Employee Phone" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="employee_address" class="form-label">Address<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" class="form-control"  name="address"
                                        placeholder="Enter Employee Address" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="gender" class="form-label">Gender <span
                                            class="text-danger">*</span></label>
                                            <select name="gender" class="form-control" required>
                                                <option value="male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="blood" class="form-label">Blood<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" class="form-control"  name="blood"
                                        placeholder="Enter Bood Name" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="nid" class="form-label">NID<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="nid"
                                        placeholder="Enter Nid Number" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="salary" class="form-label">Salary <span
                                            class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="salary"
                                            placeholder="Enter salary" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="joining_date" class="form-label">Joining Date<span
                                            class="text-danger">*</span> </label>
                                    <input type="date" class="form-control" id="joining_date" name="joining_date"
                                         required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="status" class="form-label">Status<span
                                            class="text-danger">*</span> </label>
                                            <select name="status" class="form-control" required>
                                                <option value="">Choose One</option>
                                                <option value="0">Deactive</option>
                                                <option value="1">Active</option>
                                            </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="employee_image" class="form-label">Employee Image <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control dropify" name="employee_image" data-max-file-size="3M"
                                data-allowed-file-extensions="jpg png jpeg" required />
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
    {{-- ! end new employee add --}}

    {{-- Update employee  modal --}}
    <div class="modal fade" id="update_employee_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Employee Update</h4>
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
    {{-- ! Update employee  modal --}}
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
                ajax: "{{ route('admin.hrm.employee.employee.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'employee_id',
                        name: 'employee_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
                    },
                    {
                        data: 'designation_name',
                        name: 'designation_name'
                    },
                    {
                        data: 'image',
                        render: function(data, type, full, meta) {
                            var imagePath = 'http://127.0.0.1:8000/' + data;
                            return '<img src="' + imagePath + '" height="35" width="35">';
                        }
                    },
                    {
                        data: 'salary',
                        image: 'salary'
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
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_employee_modal').modal('hide');
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                        if (response.employee_add) {
                            toastr.success(response.employee_add);
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
                let url = "{{ url('admin.hrm.employee.employee.edit') }}/" + id;
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
            $(document).on('click', '#employee_delete', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this Employee",
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
                        toastr.success(response.employee_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();

                    }
                });
            });
        });
        // submit_table class call for every change
        $(document).on('change', '.submit_table', function() {
            initializeDataTable();
        });
    </script>
@endsection
