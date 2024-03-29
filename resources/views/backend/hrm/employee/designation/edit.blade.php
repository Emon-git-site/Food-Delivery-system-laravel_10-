
<form action="{{ route('admin.hrm.employee.designation.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="designation_id" value="{{ $designation->id }}">
        <label for="designation_name" class="form-label">Designation Name <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control"  name="designation_name"
          value="{{ $designation->designation_name }}"  required>
    </div>

    <button type="submit" class="btn btn-success btn-block">UPDATE
        <span class="loading d-none"> .... </span> </button>
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
                        $('#update_designation_modal').modal('hide');

                        toastr.success(response.designation_update);
                        $('#example1').DataTable().ajax.reload();
                    }
                });
            });
</script>