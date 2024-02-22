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
                            <li class="breadcrumb-item active">Attendance Adjustment</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- /.content-header -->
        <div class="content">
            <form action="{{ route('admin.hrm.attendance.adjustment.form') }}" method="GET" >
                @csrf
                <div class="card p-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="employee">Select Employee:</label>
                                        <select class="form-control form-control-sm selectpicker" name="employee_id"
                                            id="employee_id" data-live-search="true">
                                            <option disabled="" selected="">Choose One</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }} -
                                                    {{ $employee->employee_id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="employee">Month:</label>
                                        <select class="form-control form-control-sm" name="month" required>
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
                                    <div class="col-md-4">
                                        <label for="employee">Year:</label>
                                        <select name='year' class="form-control form-control-sm" required>
                                            <option value='2024'>2024</option>
                                            <option value='2025'>2025</option>
                                            <option value='2026'>2026</option>
                                            <option value='2027'>2027</option>
                                            <option value='2028'>2028</option>
                                            <option value='2029'>2029</option>
                                            <option value='2030'>2030</option>
                                          </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success float-right">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

