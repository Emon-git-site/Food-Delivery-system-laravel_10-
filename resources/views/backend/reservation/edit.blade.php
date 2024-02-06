
<form action="{{ route('admin.reservation.update') }}" method="post" id="update_form">
    @csrf
    <div class="mb-3">
        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
        <label for="date" class="form-label">Date<span
                class="text-danger">*</span></label>
        <input type="date" class="form-control" id="date" name="date" value="{{ $reservation->r_date }}" required>
    </div>
    <div class="mb-3">
        <label for="time" class="form-label">Time <span
                class="text-danger">*</span></label>
        <input type="time" class="form-control" id="time" name="time" value="{{ $reservation->r_time }}" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone<span
                class="text-danger">*</span></label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $reservation->phone }}" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name<span
                class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $reservation->name }}" required>
    </div>
    <div class="mb-3">
        <label for="person" class="form-label">Person<span
                class="text-danger">*</span></label>
        <input type="number" class="form-control" id="person" min="1" name="people" value="{{ $reservation->people }}" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Details<span
                class="text-danger">*</span></label>
                <textarea class="form-control" name="details" cols="10" rows="2"> {{ $reservation->details }} </textarea>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone<span
                class="text-danger">*</span></label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $reservation->phone }}" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Status<span
                class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="Approved" @if($reservation->status=="Approved") selected @endif>Approveded</option>
                    <option value="Reject" @if($reservation->status=="Reject") selected @endif>Reject</option>
                    <option value="Success" @if($reservation->status=="Success") selected @endif>Success</option>
                </select>
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
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $('#update_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#update_reservation_modal').modal('hide');

                        toastr.success(response.reservation_update);
                        $('#example1').DataTable().ajax.reload();
                    }
                });
            });
</script>