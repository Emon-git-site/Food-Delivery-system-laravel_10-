@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Attendance</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.hrm.employee.award.index') }}">Attendance</a>
                            </li>
                            <li class="breadcrumb-item active">All Attendance</li>
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
                    <h3 class="card-title">Attendance List</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_attendance_modal"><i class="fa fa-plus"></i>New Attendance</button>
                </div><br>
                <div class="ml-4 mr-4">
                    <div class="row">
                        <div class="col-4">
                            <select class="form-control submit_table" name="employee_id" id="employee_id">
                                <option value="">All</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }} - {{ $employee->employee_id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select class="form-control submit_table" name="month" id="month">
                                <option value="">All</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="date" name="date" id="date" class="form-control submit_table">
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee - ID</th>
                                <th>Date</th>
                                <th>ClockIN</th>
                                <th>ClockOut</th>
                                <th>status</th>
                                <th>Month</th>
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

    {{--  new attendance  added modal --}}
    <div class="modal fade" id="add_attendance_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Attendance</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.hrm.attendance.store.missing') }}" method="post" id="add_form">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="employee_id" class="form-label">Employee <span
                                            class="text-danger">*</span></label>
                                    <select name="employee_id" class="form-control" required>
                                        <option value="">Choose Onse</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="date" class="form-label">Attendance Date<span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="clock_in" class="form-label">ClockIn <span class="text-danger">*</span>
                                    </label>
                                    <input type="time" class="form-control" name="clock_in" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="clock_out" class="form-label">Clock Out <span
                                            class="text-danger">*</span></label>
                                    <input type="time" class="form-control" name="clock_out" >
                                </div>
                                <div class="form-group col-4">
                                    <label for="clock_in_note" class="form-label">ClockkIn Notes</label>
                                    <input type="text" class="form-control" name="clock_in_note" >
                                </div>
                                <div class="form-group col-4">
                                    <label for="clock_out_note" class="form-label">ClockOut Notes </label>
                                    <input type="text" class="form-control" name="clock_out_note" >
                                </div>
                            </div>
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
    {{-- ! end new attendance add --}}

    {{-- Update attendance  modal --}}
    <div class="modal fade" id="update_attendance_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Attendance Update</h4>
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
    {{-- ! Update attendance  modal --}}
@endsection
@section('script')
    <script type="text/javascript">
        function initializeDataTable() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.hrm.attendance.AllAttendance') }}",
                    data: function(e){
                        e.employee_id = $('#employee_id').val();
                        e.month = $('#month').val();
                        e.date = $('#date').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'clock_in',
                        name: 'clock_in'
                    },
                    {
                        data: 'clock_out',
                        name: 'clock_out'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'month',
                        name: 'month'
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
                    success: function(data) {
                        let errors = data.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_attendance_modal').modal('hide');
                        if(!$.isEmptyObject(data.errorMsg)){
                            toastr.error(data.errorMsg);
                            $('.loading_button').addClass('d-none');
                        }else{
                            toastr.success(data);
                            $('.loading_button').addClass('d-none');
                            initializeDataTable();
                        }
                    }
                })
            });
        });
        // edit request send
        $(document).ready(function() {
            $('body').on('click', '.edit_modal_btn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let url = "{{ url('admin/hrm/attendance/edit') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('#update_part').html(response);

                    }
                });
            });
        });



        // delete specific attendance
        $(document).ready(function() {
            $(document).on('click', '#attendance_delete', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this Attendance",
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
                        toastr.success(response.attendance_delete);
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
