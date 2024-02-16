<form action="{{ route('admin.hrm.holiday.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="holiday_id" value="{{ $holiday->id }}">
        <label for="holiday_name" class="form-label">Holiday Type <span
                class="text-danger">*</span></label>
        <select name="type" id="type" class="form-control">
            <option value="">Choose One</option>
            <option value="Offday" @selected($holiday->type=="Offday")>Offday</option>
            <option value="Holiday" @selected($holiday->type=="Holiday")>Holiday</option>
            
        </select>
    </div>
    <div class="mb-3">
        <label for="holiday_name" class="form-label">Holiday Name <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control"  name="name" value="{{ $holiday->name }}" required>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="form-group col-4">
                <label for="from" class="form-label">From <span
                    class="text-danger">*</span></label>
            <input type="date" class="form-control start_date" name="from" value="{{ $holiday->from }}" required>
            </div>
            <div class="form-group col-4">
                <label for="to" class="form-label">To <span
                    class="text-danger">*</span></label>
            <input type="date" class="form-control end_date" name="to" value="{{ $holiday->to }}" required>
            </div>
            <div class="form-group col-4">
                <label for="num_of_days" class="form-label">Total Days <span
                    class="text-danger">*</span></label>
            <input type="integer" class="form-control num_of_days" name="num_of_days" value="{{ $holiday->num_of_days }}"  readonly>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-block">UPDATE
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
                        $('#update_holiday_modal').modal('hide');
                        let errors = response.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errors[key].forEach((message) => {
                                    toastr.error(message);
                                });
                            }
                        } 
                        if(response.holiday_update) {
                            toastr.success(response.holiday_update);
                        }
                        $('#example1').DataTable().ajax.reload();
                    }
                });
            });
</script>

