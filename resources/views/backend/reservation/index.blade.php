@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Reservation</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.reservation.index') }}">Reservation</a></li>
                            <li class="breadcrumb-item active">All Reservation</li>
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
                    <h3 class="card-title">Categories Table</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_category_modal"><i class="fa fa-plus"></i> Add New</button>
                </div>
                <br>
                <div class="ml-4 mr-4">
                    <div class="row">
                        <div class="col-4">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-4">
                            <select name="" class="form-control">
                                <option >All</option>
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
                            <select name="" class="form-control">
                                <option >All</option>
                                <option value="Approveded">Approveded</option>
                                <option value="Reject">Reject</option>
                                <option value="Success">Success</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>People</th>
                                <th>Phone</th>
                                <th>Name</th>
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

    {{--  new reservation added modal --}}
    <div class="modal fade" id="add_category_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Reservation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.reservation.store') }}" method="post" id="add_form">
                        @csrf
                        <div class="mb-3">
                            <label for="date" class="form-label">Date<span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label">Time <span
                                    class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="person" class="form-label">Person<span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="person" min="1" name="people" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Details<span
                                    class="text-danger">*</span></label>
                                    <textarea class="form-control" name="details" cols="10" rows="2"></textarea>
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
    {{-- ! new reservation added modal --}}

    {{-- Update reservation  modal --}}
    <div class="modal fade" id="update_table_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reservation Update</h4>
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
    {{-- ! Update reservation  modal --}}
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
                ajax: "{{ route('admin.reservation.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'r_date',
                        name: 'r_date'
                    },
                    {
                        data: 'r_time',
                        name: 'r_time'
                    },
                    {
                        data: 'people',
                        name: 'people'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'name',
                        name: 'name'
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

        $(document).ready(function() {
            // Call the function to initialize DataTable when the document is ready
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
                    success: function(response) {
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#add_category_modal').modal('hide');
                        toastr.success(response.add_reservation);
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });
        });
        // toaster message script
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        });
        // edit request send
        $(document).ready(function() {
            $('body').on('click', '.edit_modal', function() {
                let id = $(this).data('id');
                let url = "{{ url('category/edit') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                            $('input[name="category_id"]').val(response.id);
                            $('input[name="category_name_update"]').val(response
                                .category_name);
                    }
                });
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // update modal Submit
            $('#update_form').submit(function(e) {
                e.preventDefault();
                $('.loading').removeClass('d-none');
                let category_id = $('input[name="category_id"]').val();
                let url = "{{ url('category/update') }}/" + category_id;
                let data = {
                    'category_name': $('#category_name_update').val()
                };
                console.log(data);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    success: function(response) {
                        $('#update_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#update_category_modal').modal('hide');
                        toastr.success(response.category_update);
                        $('#example1').DataTable().ajax.reload();
                        initializeDataTable();
                    }
                })
            });
        });
    
    // delete specific Category
    $(document).ready(function(){
        $(document).on('click', '#category_delete', function(e){
            e.preventDefault();
            let url = $(this).attr('href');
            // Set the form action attribute before submitting
            $('#delete_form').attr('action', url);          
              swal({
                    title: "Are you sure to Delete this post",
                    text: "You will not be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete)=>{
                    if(willDelete){
                        $('#delete_form').submit();
                    }
                });
        });
        // data passed through here
        $('#delete_form').submit(function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            let request = $(this).serialize();
            $.ajax({
                url: url,
                data: request,
                success: function(response){
                    toastr.success(response.category_delete);
                    $('#delete_form')[0].reset(); 
                    initializeDataTable();

                }
            });
        });
    });
    </script>
@endsection
