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
                            <li class="breadcrumb-item"><a href="{{ route('admin.hrm.attendance.singleAttendance') }}">Attendance</a>
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
                    <h3 class="card-title">Attendance Rapid Update</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_attendance_modal"><i class="fa fa-plus"></i>New Attendance</button>
                </div><br>
                <div class="ml-4 mr-4">
                    <div class="row">
                        <li class="list-group-item">Name: {{ $user->name }}</li>
                        <li class="list-group-item">Employee ID: {{ $user->employee_id }}</li>
                        <li class="list-group-item">Phone: {{ $user->phone }}</li>
                        <li class="list-group-item">Salary: {{ $user->salary }}</li>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Employee - ID</th>
                                <th>Date</th>
                                <th>ClockIN</th>
                                <th>ClockOut</th>
                                <th>Month</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr role="row" class="odd">
                                @foreach ($attendance as $row)
                                    <tr role="row">
                                        <th>{{ $user->name }} - {{ $user->employee_id }}</th>
                                        <input type="hidden" class="employee_id" value="{{ $user->id }}">
                                        <input type="hidden" class="date" value="{{ $row->date }}">
                                        <th>{{ $row->date }}</th>
                                        <th><input type="time" value="{{ $row->clock_in }}" name="clock_in" class="clock_in"></th>
                                        <th><input type="time" value="{{ $row->clock_out}}" name="clock_out" class="clock_out"></th>
                                        <th>{{ $row->month }}</th>
                                        <th>
                                            @if($row->status=="Present")
                                               <span class="badge badge-success">Present</span>
                                            @else
                                               <span class="badge badge-warning">Missing</span>
                                            @endif
                                        </th>
                                    </tr>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
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
                    <h4 class="modal-title">Attendance Insert</h4>
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

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
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
                            window.location.reload();
                        }
                    }
                })
            });

            // clock in update
            $('.clock_in').blur(function(e) {
                e.preventDefault();
                let id = $('.employee_id').val();
                let date = $('.date').val();
                let clock_in = $(this).val();
                $.ajax({
                    url: "{{ url('admin/hrm/attendance/adjustment/clock_in_change') }}/" + id + '/' + date + '/' + clock_in,
                    type: 'GET',
                    success: function(data) {
                        if(!$.isEmptyObject(data.errorMsg)){
                            toastr.error(data.errorMsg);
                        }else{
                            toastr.success(data);
                        }
                    }
                })
            });
            // clock out update
            $('.clock_out').blur(function(e) {
                e.preventDefault();
                let id = $('.employee_id').val();
                let date = $('.date').val();
                let clock_out = $(this).val();
                $.ajax({
                    url: "{{ url('admin/hrm/attendance/adjustment/clock_out_change') }}/" + id + '/' + date + '/' + clock_out,
                    type: 'GET',
                    success: function(data) {
                        if(!$.isEmptyObject(data.errorMsg)){
                            toastr.error(data.errorMsg);
                        }else{
                            toastr.success(data);
                        }
                    }
                })
            });
        });

    </script>
@endsection
 