@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Holiday</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.hrm.holiday.index') }}">Holiday</a></li>
                            <li class="breadcrumb-item active">All Holiday</li>
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
                    <h3 class="card-title">Holiday List </h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_holiday_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Days</th>
                                <th>Month</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    {{-- holiday item delete form --}}
                    <form id="delete_form" action="" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    {{--  new holiday added modal --}}
    <div class="modal fade" id="add_holiday_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Holiday</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.hrm.holiday.store') }}" method="post" id="add_form">
                        @csrf
                        <div class="mb-3">
                            <label for="holiday_name" class="form-label">Holiday Type <span
                                    class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Choose One</option>
                                <option value="Offday">Offday</option>
                                <option value="Holiday">Holiday</option>
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="holiday_name" class="form-label">Holiday Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control"  name="name" placeholder="Enter Holiday Name" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="from" class="form-label">From <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control start_date"  name="from" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="to" class="form-label">To <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control end_date"  name="to" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="num_of_days" class="form-label">Total Days <span
                                        class="text-danger">*</span></label>
                                <input type="integer" class="form-control num_of_days"  name="num_of_days"  readonly>
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
    {{-- ! new holiday added modal --}}

    {{-- Update holiday  modal --}}
    <div class="modal fade" id="update_holiday_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Holiday Update</h4>
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
    {{-- ! Update holiday  modal --}}
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
                ajax: "{{ route('admin.hrm.holiday.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'from',
                        name: 'from'
                    },
                    {
                        data: 'to',
                        name: 'to'
                    },
                    {
                        data: 'num_of_days',
                        name: 'num_of_days'
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


        // modal addForm Submit
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
                        $('#add_holiday_modal').modal('hide');
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        } 
                        if(response.holiday_create) {
                            toastr.success(response.holiday_create);
                        }
                        initializeDataTable();
                        $('#example1').DataTable().ajax.reload();
                    }
                })
            });

            initializeDataTable();

            // Event handler for opening the edit modal
            $('body').on('click', '.edit_modal_btn', function() {
                let holiday_id = $(this).data('id');
                let url = "{{ url('admin/hrm/holiday/edit') }}/" + holiday_id;

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                      $('#update_part').html(response);
                    }
                });
            });

            // delete specific Holiday
            $(document).on('click', '#holiday_delete', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this Holiday",
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
                        toastr.success(response.holiday_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();

                    }
                });
            });
        });

    // off day count
    function dateDiffInDays(date1, date2){
        // round to the nearest whole number
        return Math.round((date2-date1)/(1000*60*60*24));
    }
    $(document).ready(function(){
        $('.end_date').on('change', function(){
            var date1 = $('.start_date').val();
            var date2 = $('.end_date').val();
            var daysDiff = dateDiffInDays(new Date(date1), new Date(date2));
            var totaldays = daysDiff + 1;
            $('.num_of_days').val(totaldays);
        });
        $('.start_date').on('change', function(){
            var date1 = $('.start_date').val();
            var date2 = $('.end_date').val();
            var daysDiff = dateDiffInDays(new Date(date1), new Date(date2));
            var totaldays = daysDiff + 1;
            $('.num_of_days').val(totaldays);
        });
    });
    </script>
@endsection
