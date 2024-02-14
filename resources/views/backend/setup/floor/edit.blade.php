
<form action="{{ route('admin.floor.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="floor_id" value="{{ $floor->id }}">
        <label for="floor_name_update" class="form-label">Floor Name <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control" id="floor_name_update" name="floor_name_update"
          value="{{ $floor->floor_name }}"  required>
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
                        $('#update_floor_modal').modal('hide');

                        toastr.success(response.floor_update);
                        $('#example1').DataTable().ajax.reload();
                    }
                });
            });
</script>