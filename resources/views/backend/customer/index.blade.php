@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Customer</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Customer</a></li>
                            <li class="breadcrumb-item active">All Customer</li>
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
                    <h3 class="card-title">Customer List </h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_customer_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    {{-- Customer deactive form --}}
                    <form id="deactive_form" action="" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                    {{-- Customer active form --}}
                    <form id="active_form" action="" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    {{--  new customer added modal --}}
    <div class="modal fade" id="add_customer_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.customer.store') }}" method="post" id="add_form">
                        @csrf
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Customer Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                placeholder="Enter  name" value="{{ old('customer_name') }}" required>

                        </div>
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Customer Email<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_email" name="customer_email"
                                placeholder="Enter  Email" value="{{ old('customer_email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Customer Phone <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                                placeholder="Enter Phone" value="{{ old('customer_phone') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer_password" class="form-label">Customer Password <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_password" name="customer_password"
                                placeholder="Enter password" required>
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
    {{-- ! new customer added modal --}}

    {{-- Update customer  modal --}}
    <div class="modal fade" id="update_customer_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Customer Update</h4>
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
    {{-- ! Update customer  modal --}}
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
                ajax: "{{ route('admin.customer.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
                        data: 'status',
                        name: 'status'
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
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_customer_modal').modal('hide');
                        if (response.status == 200) {
                            toastr.success(response.customer_create);
                        }
                        initializeDataTable();
                        $('#example1').DataTable().ajax.reload();
                    }
                })
            });

            initializeDataTable();

            // Event handler for opening the edit modal
            $('body').on('click', '.edit_modal_btn', function() {
                let customer_id = $(this).data('id');
                let url = "{{ url('admin/customer/edit') }}/" + customer_id;

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        console.log("emju");
                        $('#update_part').html(response);
                    }
                });
            });

            // active specific Customer
$(document).on('click', '#customer_active', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $('#active_form').attr('action', url);

    $.ajax({
        type: 'get',
        url: url,
        data: $('#active_form').serialize(), 
        success: function(response) {
            if (response.status == 200) {
                toastr.success(response.customer_activate);
            }
            initializeDataTable(); 
        }
    });
});


            // deactive specific Customer
            $(document).on('click', '#customer_deacitve', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $('#deactive_form').attr('action', url);
                swal({
                        title: "Are you sure to Deactivate this Customer",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((deActive) => {
                        if (deActive) {
                            $('#deactive_form').submit();
                        }
                    });
            });
            // data passed through here
            $('#deactive_form').submit(function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let request = $(this).serialize();
                $.ajax({
                    url: url,
                    data: request,
                    success: function(response) {
                        if (response.status == 400) {
                            toastr.success(response.customer_deactivate);
                        }
                        $('#deactive_form')[0].reset();
                        initializeDataTable();
                    }
                });
            });
        });
    </script>
@endsection
