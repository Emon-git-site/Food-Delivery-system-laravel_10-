<form action="{{ route('admin.table.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="table_id" value="{{ $table->id }}">

        <label for="floor_name" class="form-label">Floor Name <span class="text-danger">*</span></label>
        <select class="form-control" name="floor_id" required>
            @foreach ($floors as $row)
                <option value="{{ $row->id }}" {{ $row->id == $table->floor_id ? 'selected' : '' }}>
                    {{ $row->floor_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="table_code" class="form-label">Table Code <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="table_code" name="table_code" value="{{ $table->table_code }}" required>
    </div>
    <div class="mb-3">
        <label for="table_sit" class="form-label">Table Sit <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="table_sit" name="table_sit" value="{{ $table->table_sit }}" required>
    </div>
    <button type="submit" class="btn btn-success btn-block">UPDATE
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
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $('#update_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#update_table_modal').modal('hide');

                        toastr.success(response.table_update);
                        $('#example1').DataTable().ajax.reload();
                    }
                });
            });
</script>