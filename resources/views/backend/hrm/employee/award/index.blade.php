@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Award</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.hrm.employee.award.index') }}">Award</a></li>
                            <li class="breadcrumb-item active">All Award</li>
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
                    <h3 class="card-title">Award List</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_award_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee - ID</th>
                                <th>Award Name</th>
                                <th>Award</th>
                                <th>Date</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Details</th>
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

    {{--  new award  added modal --}}
    <div class="modal fade" id="add_award_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Award</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.hrm.employee.award.store') }}" method="post" id="add_form"
                        enctype="multipart/form-data">
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
                                    <label for="award_name" class="form-label">Award Name<span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="award_name"
                                        placeholder="Enter Award Name" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="award" class="form-label">Award <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="award"
                                        placeholder="Enter Award" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="award_date" class="form-label">Award Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="award_date" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="award_month" class="form-label">Award Month <span
                                            class="text-danger">*</span></label>
                                    <select name="award_month" class="form-control" required>
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
                                <div class="form-group col-4">
                                    <label for="award_year" class="form-label">Award Year <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="award_year" value="{{ date('Y') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="from-group">
                                <label for="award_details" class="form-label">Award Details <span
                                    class="text-danger">*</span></label>
                                <textarea class="form-control" name="details" ></textarea>
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
    {{-- ! end new award add --}}

    {{-- Update award  modal --}}
    <div class="modal fade" id="update_award_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Award Update</h4>
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
    {{-- ! Update award  modal --}}
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
                ajax: "{{ route('admin.hrm.employee.award.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'award_name',
                        name: 'award_name'
                    },
                    {
                        data: 'award',
                        name: 'award'
                    },
                    {
                        data: 'award_date',
                        name: 'award_date'
                    },
                    {
                        data: 'award_month',
                        name: 'award_month'
                    },
                    {
                        data: 'award_year',
                        name: 'award_year'
                    },
                    {
                        data: 'details',
                        name: 'details'
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
                        $('#add_award_modal').modal('hide');
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                        if (response.award_add) {
                            toastr.success(response.award_add);
                        }
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });
        });
        // edit request send
        $(document).ready(function() {
            $('body').on('click', '.edit_modal_btn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let url = "{{ url('admin/hrm/employee/award/edit') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('#update_part').html(response);

                    }
                });
            });
        });



        // delete specific award
        $(document).ready(function() {
            $(document).on('click', '#award_delete', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this Award",
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
                        toastr.success(response.award_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();

                    }
                });
            });
        });
    </script>
@endsection
