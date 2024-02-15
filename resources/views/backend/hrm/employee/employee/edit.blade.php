 <form action="{{ route('admin.hrm.employee.employee.update') }}" method="post" id="update_form"
enctype="multipart/form-data">
@csrf
<div class="mb-3">
    <div class="row">
        <div class="form-group col-6">
            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
            <label for="employee_id" class="form-label">Employee ID <span
                    class="text-danger">*</span></label>
            <input type="text" class="form-control" name="employee_id"
                value="{{ $employee->employee_id }}" required>
        </div>
        <div class="form-group col-6">
            <label for="employee_name" class="form-label">Employee Name<span
                    class="text-danger">*</span> </label>
            <input type="text" class="form-control"  name="name"
                value="{{ $employee->name }}" required>
        </div>
    </div>
</div>
<div class="mb-3">
    <div class="row">
        <div class="form-group col-6">
            <label for="department" class="form-label">Department <span
                    class="text-danger">*</span></label>
            <select name="department_id" class="form-control" required>
                <option value="">Choose One</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}"{{ ($department->id==$employee->department_id)? "selected":'' }}>{{ $department->department_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-6">
            <label for="designation" class="form-label">Designation <span
                    class="text-danger">*</span></label>
            <select name="designation_id" class="form-control" required>
                <option value="">Choose One</option>
                @foreach ($designations as $designation)
                    <option value="{{ $designation->id }}"{{ ($designation->id==$employee->designation_id)? "selected":'' }}>{{ $designation->designation_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="mb-3">
    <div class="row">
        <div class="form-group col-6">
            <label for="employee_number" class="form-label">Phone Number <span
                    class="text-danger">*</span></label>
            <input type="text" class="form-control" name="phone"
                value="{{ $employee->phone }}" required>
        </div>
        <div class="form-group col-6">
            <label for="employee_address" class="form-label">Address<span
                    class="text-danger">*</span> </label>
            <input type="text" class="form-control"  name="address"
                value="{{ $employee->address }}" required>
        </div>
    </div>
</div>
<div class="mb-3">
    <div class="row">
        <div class="form-group col-4">
            <label for="gender" class="form-label">Gender <span
                    class="text-danger">*</span></label>
                    <select name="gender" class="form-control" required>
                        <option value="Male" {{ ($employee->gender== "Male")? "selected":'' }}>Male</option>
                        <option value="Female" {{ ($employee->gender=="Female")? "selected":'' }}>Female</option>
                        <option value="Other" {{ ($employee->gender=="Other")? "selected":'' }}>Other</option>
                    </select>
        </div>
        <div class="form-group col-4">
            <label for="blood" class="form-label">Blood<span
                    class="text-danger">*</span> </label>
            <input type="text" class="form-control"  name="blood"
                value="{{ $employee->blood }}" required>
        </div>
        <div class="form-group col-4">
            <label for="nid" class="form-label">NID<span
                    class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="nid"
                value="{{ $employee->nid }}" required>
        </div>
    </div>
</div>
<div class="mb-3">
    <div class="row">
        <div class="form-group col-4">
            <label for="salary" class="form-label">Salary <span
                    class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="salary"
                    value="{{ $employee->salary }}"required>
        </div>
        <div class="form-group col-4">
            <label for="joining_date" class="form-label">Joining Date<span
                    class="text-danger">*</span> </label>
            <input type="date" class="form-control"  name="joining_date" value="{{ $employee->joining_date }}"
                 required>
        </div>
        <div class="form-group col-4">
            <label for="status" class="form-label">Status<span
                    class="text-danger">*</span> </label>
                    <select name="status" class="form-control" required>
                        <option value="">Choose One</option>
                        <option value="0" @selected($employee->status == 0)>Deactive</option>
                        <option value="1" @selected($employee->status == 1)>Active</option>
                    </select>
        </div>
    </div>
</div>
<div class="mb-3">
    <div class="row">
        <div class="col-6">
            <label for="employee_image" class="form-label">Image Upload <span
                    class="text-danger">*</span></label>
            <input type="file" class="form-control dropify" name="employee_image"
                data-max-file-size="3M" data-allowed-file-extensions="jpg png jpeg" />
        </div>
        <div class="col-6">
            <label for="employee_image" class="form-label">Old Image: </label><br>
            <img src="{{ asset($employee->image) }}" name="employee_image" height="245px" width="210px">
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success btn-block">UPDATE
    <span class="loading d-none"> .... </span>
</button>
</form>

<script type="text/javascript">
$(document).ready(function() {
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
    });
</script>
