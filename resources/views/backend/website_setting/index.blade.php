@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Website Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">home</a></li>
                            <li class="breadcrumb-item active">Website setting</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- /.content-header -->
        <div class="content">
            <form action="{{ route('admin.website_setting.update') }}" method="POST" id="update_website_setting_form"
                enctype="multipart/form-data">
                @csrf
                <div class="card p-2 col-6">
                    <div class="form-group">
                        <label for="award_year" class="form-label">Currency </label>
                        <select name="currency" class="form-control">
                            <option value="">Choose One</option>
                            <option value="৳" @selected($website_setting->currency == '৳')>Taka</option>
                            <option value="$" @selected($website_setting->currency == '$')>USD</option>
                            <option value="₹" @selected($website_setting->currency == '₹')>Rupee</option>
                            <option value="€" @selected($website_setting->currency == '€')>Euro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone_one" class="form-label">Phone One </label>
                        <input type="text" class="form-control" name="phone_one"
                            value="{{ $website_setting->phone_one }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_two" class="form-label">Phone Two </label>
                        <input type="text" class="form-control" name="phone_two"
                            value="{{ $website_setting->phone_two }}" required>
                    </div>
                    <div class="form-group">
                        <label for="main_email" class="form-label">Main Email </label>
                        <input type="text" class="form-control" name="main_email"
                            value="{{ $website_setting->main_email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="support_email" class="form-label">Support Email </label>
                        <input type="text" class="form-control" name="support_email"
                            value="{{ $website_setting->support_email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Address </label>
                        <input type="text" class="form-control" name="address" value="{{ $website_setting->address }}"
                            required>
                    </div>
                    <p class="text-success">Social Link</p>
                    <div class="form-group">
                        <label for="twitter" class="form-label">Twitter </label>
                        <input type="text" class="form-control" name="twitter" value="{{ $website_setting->twitter }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="instagram" class="form-label">Instagram </label>
                        <input type="text" class="form-control" name="instagram"
                            value="{{ $website_setting->instagram }}" required>
                    </div>
                    <div class="form-group">
                        <label for="linkedin" class="form-label">Linkedin </label>
                        <input type="text" class="form-control" name="linkedin" value="{{ $website_setting->linkedin }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="youtube" class="form-label">Youtube </label>
                        <input type="text" class="form-control" name="youtube" value="{{ $website_setting->youtube }}"
                            required>
                    </div>
                    <p class="text-success">Logo $ Favicon</p>
                    <div class="form-group">
                        <label for="main_logo" class="form-label">Main Logo </label>
                        <input type="file" class="form-control" name="main_logo">
                    </div>
                    <div class="form-group">
                        <label for="favicon" class="form-label">Favicon </label>
                        <input type="file" class="form-control" name="favicon">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success ">UPDATE</button>
                        <button type="btn" class="btn loading_button  d-none"><i
                                class="fas fa-spinner"></i><b>Loading...</b>UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
$(document).ready(function() {
    alert('sdlkfjsd');
    // add attendance by ajax
    $('#update_website_setting_form').on('submit', function(e) {
        e.preventDefault();
        $('.loading_button').removeClass('d-none');

        var formData = new FormData(this); 

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false, 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(data) {
                $('.loading_button').addClass('d-none'); 

                if (data.errors) { 
                    let errors = data.errors;
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errors[key].forEach((message) => {
                                toastr.error(message);
                            });
                        }
                    }
                }

                if (data.setting_update) { 
                    toastr.success(data.setting_update);
                }
            },
        });
    });
});

    </script>
@endsection
