
<form action="{{ route('admin.hrm.attendance.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <div class="row">
            <div class="form-group col-4">
                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                <label for="employee_id" class="form-label">Employee <span
                        class="text-danger">*</span></label>
                <select name="employee_id" class="form-control" required>
                    <option value="">Choose Onse</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" @selected($employee->id==$attendance->employee_id)>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4">
                <label for="date" class="form-label">Attendance Date<span
                        class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" name="date" value="{{ $attendance->date }}" readonly required>
            </div>
            <div class="form-group col-4">
                <label for="clock_in" class="form-label">ClockIn <span class="text-danger">*</span>
                </label>
                <input type="time" class="form-control" name="clock_in" value="{{ $attendance->clock_in }}" required>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="form-group col-4">
                <label for="clock_out" class="form-label">Clock Out <span
                        class="text-danger">*</span></label>
                <input type="time" class="form-control" name="clock_out" value="{{ $attendance->clock_out }}">
            </div>
            <div class="form-group col-4">
                <label for="clock_in_note" class="form-label">ClockkIn Notes</label>
                <input type="text" class="form-control" name="clock_in_note" value="{{ $attendance->clock_in_note }}">
            </div>
            <div class="form-group col-4">
                <label for="clock_out_note" class="form-label">ClockOut Notes </label>
                <input type="text" class="form-control" name="clock_out_note" value="{{ $attendance->clock_out_note }}">
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
                    success: function(data) {
                        let errors = data.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        }
                        $('#update_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#update_attendance_modal').modal('hide');
                        toastr.success(data);
                        initializeDataTable();
                    }
                });
            });
</script>