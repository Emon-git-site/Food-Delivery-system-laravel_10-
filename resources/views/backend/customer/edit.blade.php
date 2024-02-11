<form action="{{ route('admin.customer.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
        <label for="customer_name" class="form-label">Customer Name <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control" id="customer_name" name="customer_name"
             value="{{ $customer->name }}" required>

    </div>
    <div class="mb-3">
        <label for="customer_email" class=" form-label">Customer Email<span
                class="text-danger">*</span></label>
        <input type="text" class="form-control" id="customer_email" name="customer_email"
             value="{{ $customer->email }}" required>
    </div>
    <div class="mb-3">
        <label for="customer_phone" class="form-label">Customer Phone <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control" id="customer_phone" name="customer_phone"
             value="{{ $customer->phone }}" required>
    </div>
    <button type="submit" class="btn btn-success btn-block">UPDATE
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
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $('#update_form')[0].reset();
                $('.loading').addClass('d-none');
                $('#update_customer_modal').modal('hide');
                if (response.status == 200) {
                    toastr.success(response.customer_update);
                }
                $('#example1').DataTable().ajax.reload();
            }
        });
    });
</script>
