
<form action="{{ route('admin.expense.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="expense_id" value="{{ $expense->id }}">
        <label for="expense_type" class="form-label">Select Type <span
                class="text-danger">*</span></label>
        <select name="expense_type_id" class="form-control">
            <option value="">Choose One</option>
            @foreach ($expenseTypes as $expenseType)
            <option value="{{ $expenseType->id }}" {{ ($expenseType->id==$expense->expensetype_id)? 'selected':'' }}>{{ $expenseType->type_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="expense_amount" class="form-label">Amount <span class="text-danger">*</span></label>
        <input type="text" class="form-control"  name="expense_amount" value="{{ $expense->amount }}" required>
    </div>
    <div class="mb-3">
        <label for="expense_details" class="form-label">Details <span
                class="text-danger">*</span></label>
        <input type="text" class="form-control"  name="expense_details" value="{{ $expense->details }}" required>
    </div>
    <button type="submit" class="btn btn-success btn-block">SUBMIT
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
                        $('#update_expense_modal').modal('hide');

                        toastr.success(response.expense_update);
                        $('#example1').DataTable().ajax.reload();
                    }
                });
            });
</script>