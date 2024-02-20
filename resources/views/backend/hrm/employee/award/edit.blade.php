<form action="{{ route('admin.hrm.employee.award.update') }}" method="post" id="update_form"
enctype="multipart/form-data">
@csrf
<div class="mb-3">
    <div class="row">
        <div class="form-group col-4">
            <input type="hidden" name="award_id" value="{{ $award->id }}">
            <label for="employee_id" class="form-label">Employee <span
                    class="text-danger">*</span></label>
            <select name="employee_id" class="form-control" required>
                <option value="">Choose Onse</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" @selected($employee->id==$award->employee_id)>{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-4">
            <label for="award_name" class="form-label">Award Name<span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" name="award_name"
                value="{{ $award->award_name }}" required>
        </div>
        <div class="form-group col-4">
            <label for="award" class="form-label">Award <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" name="award"
            value="{{ $award->award }}"  required>
        </div>
    </div>
</div>
<div class="mb-3">
    <div class="row">
        <div class="form-group col-4">
            <label for="award_date" class="form-label">Award Date <span
                    class="text-danger">*</span></label>
            <input type="date" class="form-control" value="{{ $award->award_date }}" name="award_date" required>
        </div>
        <div class="form-group col-4">
            <label for="award_month" class="form-label">Award Month <span
                    class="text-danger">*</span></label>
            <select name="award_month" class="form-control"  required>
                <option value="January" @selected($award->award_month=="January")>January</option>
                <option value="February" @selected($award->award_month=="February")>February</option>
                <option value="March" @selected($award->award_month=="March")>March</option>
                <option value="April" @selected($award->award_month=="April")>April</option>
                <option value="May" @selected($award->award_month=="May")>May</option>
                <option value="June" @selected($award->award_month=="June")>June</option>
                <option value="July" @selected($award->award_month=="July")>July</option>
                <option value="August" @selected($award->award_month=="August")>August</option>
                <option value="September" @selected($award->award_month=="September")>September</option>
                <option value="October" @selected($award->award_month=="October")>October</option>
                <option value="November" @selected($award->award_month=="November")>November</option>
                <option value="December" @selected($award->award_month=="December")>December</option>
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
        <textarea class="form-control" name="details" required>{{ $award->details}}</textarea>
    </div>
</div>
<button type="submit" class="btn btn-success btn-block">SUBMIT
<span class="loading d-none"> .... </span>
</button>
</form>

<script type ="text/javascript">
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
                $('#update_award_modal').modal('hide');
                toastr.success(response.award_update);
                $('#example1').DataTable().ajax.reload();
            }
        });
    });
</script>
