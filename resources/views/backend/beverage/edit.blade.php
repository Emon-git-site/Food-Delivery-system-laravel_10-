
<form action="{{ route('admin.beverage.update') }}" method="post" id="update_form" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="beverage_id" value="{{ $beverage->id }}">
        <label for="beverage_name" class="form-label">Beverage Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control"  name="beverage_name" value="{{ $beverage->b_name }}"
             required>
    </div>
    <div class="mb-3">
            <div class="form-group ">
                <label for="beverage_price" class="form-label">Beverage price <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" name="beverage_price" value="{{ $beverage->b_price }}"
                     required>
            </div>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label for="beverage_image" class="form-label">Image Upload <span
                        class="text-danger">*</span></label>
                <input type="file" class="form-control dropify" name="beverage_image"
                    data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg" />
            </div>
            <div class="col-6">
                <label for="old_image" class="form-label">Old Image: </label><br>
                <img src="{{ asset($beverage->b_image) }}" name="beverage_image" height="245px" width="210px">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-block">UPDATE
        <span class="loading d-none"> .... </span>
    </button>
</form>

<script type="text/javascript">
$('.dropify').dropify();

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
                let errors = response.errors;
                for (let key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errors[key].forEach((message) => {
                            toastr.error(message);
                        });
                    }
                }
                $('#update_form')[0].reset();
                $('.loading').addClass('d-none');
                $('#update_beverage_modal').modal('hide');
                if(response.food_update){
                    toastr.success(response.beverage_update);
                }
                $('#example1').DataTable().ajax.reload();
            }
        });
    });
</script>
