
<form action="{{ route('admin.hrm.employee.employee.update') }}" method="post" id="update_form" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="food_id" value="{{ $food->id }}">
        <label for="expense_type" class="form-label">Select Category <span class="text-danger">*</span></label>
        <select name="subcategory_id" class="form-control">
            <option value="">Select One</option>
            @foreach ($categories as $category)
                <option disabled class="text-primary">{{ $category->category_name }}</option>
                @foreach ($category->subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}"
                        {{ $subcategory->id == $food->subcategory_id ? 'selected' : '' }}>
                        --{{ $subcategory->subcategory_name }}
                    </option>
                @endforeach
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="food_name" class="form-label">Food Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="food_name" name="food_name" value="{{ $food->name }}" required>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="form-group col-6">
                <label for="food_price" class="form-label">Food price <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="food_price" name="food_price" value="{{ $food->price }}"
                    required>
            </div>
            <div class="form-group col-6">
                <label for="food_discournt_price" class="form-label">Food Discount Price </label>
                <input type="text" class="form-control" id="food_discournt_price" name="food_discournt_price"
                    value="{{ $food->discount_price }}" required>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="food_description" class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="food_description" class="form-control" cols="30" rows="2">{{ $food->description }}</textarea>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label for="food_image" class="form-label">Image Upload <span
                        class="text-danger">*</span></label>
                <input type="file" class="form-control dropify" name="food_image"
                    data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg" />
            </div>
            <div class="col-6">
                <label for="old_image" class="form-label">Old Image: </label><br>
                <img src="{{ asset($food->image) }}" name="food_image" height="245px" width="210px">
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="food_status" class="form-label">Status <span class="text-danger">*</span></label>
        <select name="food_status" class="form-control" required>
            <option value="1" {{ $food->status==1 ? 'selected' : '' }}>Publish</option>
            <option value="0" {{ $food->status==0 ? 'selected' : '' }}>Unpublish</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success btn-block">SUBMIT
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
                $('#update_employee_modal').modal('hide');
                if(response.employee_update){
                    toastr.success(response.employee_update);
                }
                $('#example1').DataTable().ajax.reload();
            }
        });
    });
</script>
