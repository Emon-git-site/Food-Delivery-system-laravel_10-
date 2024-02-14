@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Expense</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.expense.index') }}">Expense</a></li>
                            <li class="breadcrumb-item active">All Expense</li>
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
                    <h3 class="card-title">Expense List </h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_expense_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Expense Type</th>
                                <th>Amount</th>
                                <th>Details</th>
                                <th>Date</th>
                                <th>Month</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    {{-- expense item delete form --}}
                    <form id="delete_form" action="" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    {{--  new expense added modal --}}
    <div class="modal fade" id="add_expense_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Expense</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.expense.store') }}" method="post" id="add_form">
                        @csrf
                        <div class="mb-3">
                            <label for="expense_type" class="form-label">Select Type <span
                                    class="text-danger">*</span></label>
                            <select name="expense_type_id" class="form-control">
                                <option value="">Choose One</option>
                                @foreach ($expenseTypes as $expenseType)
                                <option value="{{ $expenseType->id }}">{{ $expenseType->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="expense_amount" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"  name="expense_amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="expense_details" class="form-label">Details <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control"  name="expense_details" required>
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

    {{-- Update expense  modal --}}
    <div class="modal fade" id="update_expense_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Expense Update</h4>
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
    {{-- ! Update expense  modal --}}
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
                ajax: "{{ route('admin.expense.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'type_name',
                        name: 'type_name'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'details',
                        name: 'details'
                    },
                    {
                        data: 'date',
                        name: 'date'
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
                        $('#add_expense_modal').modal('hide');
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                        if(response.expense_create){
                            toastr.success(response.expense_create);
                        }
                        initializeDataTable();
                        $('#example1').DataTable().ajax.reload();
                    }
                })
            });

            initializeDataTable();

            // Event handler for opening the edit modal
            $('body').on('click', '.edit_modal_btn', function() {
                let expense_id = $(this).data('id');
                let url = "{{ url('admin/expense/edit') }}/" + expense_id;

                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        $('#update_part').html(response);
                    }
                });
            });

            // delete specific Floor
            $(document).on('click', '#expense_delete', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $('#delete_form').attr('action', url);
                swal({
                        title: "Are you sure to Delete this Expense",
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
                        toastr.success(response.expense_delete);
                        $('#delete_form')[0].reset();
                        initializeDataTable();

                    }
                });
            });
        });
    </script>
@endsection
