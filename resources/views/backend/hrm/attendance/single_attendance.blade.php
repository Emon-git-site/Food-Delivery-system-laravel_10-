@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employee Attendance</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">home</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- /.content-header -->
        <div class="content">
            <form action="{{ route('admin.hrm.attendance.store.personWise') }}" method="POST" id="add_attendance_form">
                @csrf
                <div class="card p-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="employee">Select Employee:</label>
                                        <select class="form-control form-control-sm selectpicker" name=""
                                            id="employee_id" data-live-search="true">
                                            <option disabled="" selected="">Choose One</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }} -
                                                    {{ $employee->employee_id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title">Employee List</h5>
                            </div>
                        </div>
                    </div>

                    <div class="create_attendance_table">
                        <div class="table-responsive">
                            <table class="table employee-datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Employee</th>
                                        <th>Clock-In</th>
                                        <th>Clock-Out</th>
                                        <th>Clock In Note</th>
                                        <th>Clock Out Note</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="attendance_row">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success float-right">SAVE</button>
                        <button type="btn" class="btn loading_button float-right d-none"><i
                                class="fas fa-spinner"></i><b>Loading...</b>SAVE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#employee_id', function() {
                var user_id = $(this).val();
                // var name = $(this).data('name');
                var count = 0;

                $('.create_attendance_table table').find('tr').each(function() {
                    if ($(this).data('user_id') == user_id) {
                        count++;
                    }
                });

                if (user_id && count == 0) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/hrm/attendance/create/person-wise-row') }}/" + user_id,
                        success: function(data) {
                            $('#attendance_row').append(data);
                        }
                    });
                }

            }); 

            $(document).on('click', '.btn_remove', function(){
                $(this).closest('tr').remove();
            });

            // add attendance by ajax
            $('#add_attendance_form').on('submit', function (e) {
                e.preventDefault(); 
                $('.loading_button').removeClass('d-none');
                var url = $(this).attr('action');
                var request = $(this).serialize();
                $.ajax({
                    type: "post",
                    url: url,
                    data: request,
                    success: function (data) {
                        let errors = data.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                        if(!$.isEmptyObject(data.errorMsg)){
                            toastr.error(data.errorMsg);
                            $('.loading_button').addClass('d-none');
                        }else{
                            toastr.success(data);
                            $('.loading_button').addClass('d-none');
                            window.location = "{{ route('admin.hrm.attendance.singleAttendance') }}";                
                        }
                    }
                });
            });
        });
    </script>
@endsection
