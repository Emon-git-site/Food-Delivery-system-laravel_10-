<form action="{{ route('admin.hrm.leave.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="leave_id" value="{{ $leave->id }}">
        <div class="row">
            <div class="form-group col-6">
                <label for="from" class="form-label">Employee Name<span
                        class="text-danger">*</span></label>
                <select name="employee_id" class="form-control" required>
                    <option value="">Choose One</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" @selected($employee->id==$leave->employee_id)>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label for="to" class="form-label">Leave Type <span
                        class="text-danger">*</span></label>
                <select name="leavetype_name" class="form-control" required>
                    @foreach ($leaveTypes as $leaveType)
                        <option value="{{ $leaveType->type_name }}" @selected($leaveType->type_name==$leave->leavetype_name)>
                            @switch($leaveType->type_name)
                                @case('CL')
                                    Casual Leave
                                @break

                                @case('SL')
                                    Sick Leave
                                @break

                                @case('EL')
                                    Earned Leave
                                @break

                                @default
                                    {{ $leaveType->type_name }}
                            @endswitch
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="form-group col-6">
                <label for="from" class="form-label">From <span class="text-danger">*</span></label>
                <input type="date" class="form-control start_date" name="start_date" value="{{ $leave->start_date }}" required>
            </div>
            <div class="form-group col-6">
                <label for="to" class="form-label">To <span class="text-danger">*</span></label>
                <input type="date" class="form-control end_date" name="end_date" value="{{ $leave->end_date }}" required>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="form-group col-6">
                <label for="num_of_days" class="form-label">Total Days <span
                        class="text-danger">*</span></label>
                <input type="integer" class="form-control num_of_days" name="leave_day" value="{{ $leave->leave_day }}" readonly>
            </div>
            <div class="form-group col-6">
                <label for="status" class="form-label">Status <span
                        class="text-danger">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="0" @selected($leave->status=='0')>Pending</option>
                    <option value="1" @selected($leave->status=='1')>Approved</option>
                    <option value="3" @selected($leave->status=='3')>Declined</option>
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-block">SUBMIT
        <span class="loading d-none"> .... </span>
    </button>
</form>

<script type ="text/javascript">
            // Event handler for submitting the update form
            $('#update_form').submit(function(e) {
                e.preventDefault();
                $('.loading').removeClass('d-none');

                let url = $(this).attr('action');
                let request = $(this).serialize();

                $.ajax({
                    url: url,
                    type: 'post',
                    data: request,
                    success: function(response) {
                        $('#update_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#update_leave_modal').modal('hide');
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        } 
                        if(response.leave_update) {
                            toastr.success(response.leave_update);
                        }
                        $('#example1').DataTable().ajax.reload();
                    }
                });
            });
</script>

