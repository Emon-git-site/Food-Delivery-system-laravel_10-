<form action="{{ route('admin.customer-comment.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="customer_id" value="{{ $customer_comment->id }}">
        <label for="customer_name" class="form-label">Customer Name <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control" id="customer_name" name="customer_name"
             value="{{ $customer_comment->name }}" readonly>

    </div>
    <div class="mb-3">
        <label for="rating" class=" form-label">Rating<span
                class="text-danger">*</span></label>
        <input type="text" class="form-control"  
             value="{{ $customer_comment->rating }}" readonly>
    </div>
    <div class="mb-3">
        <label for="customer_email" class=" form-label">Customer Message<span
                class="text-danger">*</span></label>
             <textarea class="form-control" rows="5">{{ $customer_comment->message }}</textarea>
    </div>
    <div class="mb-3">
        <label for="customer_email" class=" form-label">Customer Message<span
                class="text-danger">*</span></label>
                <select class="form-control" name="status" >
                    <option value="0" @selected($customer_comment->status==0)>Pending</option>
                    <option value="1" @selected($customer_comment->status==1)>Approved</option>
                </select>
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
                $('#update_customer-comment_modal').modal('hide');
                if (response.comment_update) {
                    toastr.success(response.comment_update);
                }
                $('#example1').DataTable().ajax.reload();
            }
        });
    });
</script>
