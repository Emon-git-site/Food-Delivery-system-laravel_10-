<form action="{{ route('admin.hrm.leaveType.update') }}" method="post" id="update_form">
    @csrf
    
    <div class="mb-3">
        <input type="hidden" name="leaveType_id" value="{{ $leaveType->id }}">
        <label for="type_name" class="form-label">Type Name <span class="text-danger">*</span></label>
        <select name="type_name" id="type_name" class="form-control" required>
            <option value="">Choose One</option>
            <option value="CL" @if($leaveType->type_name == 'CL') selected @endif>Casual Leave</option>
            <option value="SL" @if($leaveType->type_name == 'SL') selected @endif>Sick Leave</option>
            <option value="EL" @if($leaveType->type_name == 'EL') selected @endif>Earned Leave</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="leave_day" class="form-label">Days <span class="text-danger">*</span></label>
        <input type="number" class="form-control" id="leave_day" name="leave_day" value="{{ $leaveType->leave_day }}" required>
    </div>
    <button type="submit" class="btn btn-success btn-block">SUBMIT
        <span class="loading d-none"> .... </span>
    </button>
</form>


<script type="text/javascript">
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
                $('#update_leaveType_modal').modal('hide');

                toastr.success(response.leaveType_update);
                $('#example1').DataTable().ajax.reload();
            }
        });
    });
</script>