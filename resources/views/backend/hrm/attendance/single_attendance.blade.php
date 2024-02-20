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
                            <li class="breadcrumb-item active">Attendance</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Person By Person Attendance</h3>
                            </div>
                            <form action="" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="employee">Select Employee</label>
                                        <select class="form-control" name="employee" id="employee" data-live-search="true">
                                            <option disabled="" selected="">Choose One</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }} -
                                                    {{ $employee->employee_id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <form action="" method="post">
                                @csrf
                                <div class="card-body"> 

                                    <div class="row">
                                        <div class="form-group col-3">
                                            Employee
                                        </div>
                                        <div class="form-group col-3">
                                            Clock IN
                                        </div>
                                        <div class="form-group col-3">
                                            Clock Out
                                        </div>
                                        <div class="form-group col-3">
                                            Action
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-3">
                                            <input type="text" class="form-control" readonly name="employee_id"
                                                value="Masum" placeholder="Employee Name">
                                        </div>
                                        <div class="form-group col-3">
                                            <input type="time" class="form-control" readonly name="clock_in"
                                                placeholder="Clock IN">
                                        </div>
                                        <div class="form-group col-3">
                                            <input type="time" class="form-control" readonly name="clock_out"
                                                placeholder="Clock Out    ">
                                        </div>
                                        <div class="form-group col-3">
                                            <button class="btn btn-sm btn-danger">X</button>
                                        </div>
                                    </div>

                                    <br>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Attendance Insert</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script type="text/javascript"></script>
@endsection
