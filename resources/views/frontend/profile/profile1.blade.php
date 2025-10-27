@extends('frontend.template.master')PR
@section('title',  "My Profile")

@section('content') 
@include('frontend.template.usermenu1')


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<style>
    .ui-datepicker-calendar { display: none;}.ui-datepicker-month { display: none; }.row1{column-gap:10px;padding:0 8px 0 17px}.col-form-label{padding:0}.row1 .form-group{width:48%}.form-group{margin-bottom:10px}.select2-container--default .select2-selection--multiple{border:1px solid #dcdcdc;min-height:40px!important}.select2-container--default .select2-selection--single{height:40px}.select2-container--default .select2-selection--single .select2-selection__rendered{color:#444;line-height:40px}.account-card{height:auto}.form-control{border:1px solid #00000040!important}.form-control:focus{border-color:#00b6f552!important}.form-control:focus{color:#000!important}.form-control{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;background-color:#fff;background-clip:padding-box;border:1px solid #000;height:40px!important;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;box-shadow:none ! IMPORTANT}.form-control:focus{outline:none;box-shadow:none;color:#fff;background:#fff;border-color:var(--primary)}
    .password-container {
        position: relative;
    }

    .password-container input {
        width: 100%;
        padding-right: 40px;
    }

    .password-container .form-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: 1.2em;
        color: #000; 
    }

    /* Base card style */
.account-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.3s ease-in-out;
}

/* Hover effect */
.account-card:hover {
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
    transform: translateY(-3px);
}

/* Title section */
.account-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #f1f1f1;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.account-title h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
}

.account-title a {
    font-size: 0.9rem;
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.account-title a:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* Card list */
.account-card-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.account-card-list li {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px dashed #e0e0e0;
}

.account-card-list li h5 {
    font-weight: 600;
    font-size: 0.95rem;
    color: #444;
    margin: 0;
    flex: 1;
}

.account-card-list li p {
    font-size: 0.9rem;
    color: #666;
    margin: 0;
    text-align: right;
    flex: 1;
}

/* Responsive layout */
@media (min-width: 767px) {
    .col-lg-6 {
        display: flex;
        flex-direction: column;
    }
}



</style>

<section class="profile-part">
    <div class="container">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- Basic Info -->
                <div class="account-card">
                    <div class="account-title">
                        <h3>Basic Info</h3>
                        <a href="{{ route('basicInfo') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li><h5>Name:</h5><p>{{ $user->name }}</p></li>
                        <li><h5>User Id:</h5><p>{{ $user->uid }}</p></li>
                        <li><h5>Username:</h5><p>{{ $user->username }}</p></li>
                        <li><h5>Email:</h5><p>{{ $user->email }}</p></li>
                        <li><h5>Phone:</h5><p>+{{ $user->phone }}</p></li>
                        <li><h5>Account Type</h5><p>{{ $acc_type }}</p></li>

                        @if($user->account_type == 2)
                        <li>
                            <h5>Business A/c. Status</h5>
                            @php
                                $status = $user->is_admin_approved == 1 ? 'Enable' : 'Pending';
                                $backgroundColor = $user->is_admin_approved == 1 ? 'green' : 'orange';
                            @endphp
                            <div style="background-color: {{ $backgroundColor }}; color:white; padding:0 10px; border-radius:5px;">
                                {{ $status }}
                            </div>
                        </li>
                        @endif

                        @if($user->account_type == 3)
                        <li>
                            <h5>Business A/c. Status</h5>
                            @php
                                $status = $user->is_admin_approved == 1 ? 'Enable' : 'Pending';
                                $backgroundColor = $user->is_admin_approved == 1 ? 'green' : 'orange';
                            @endphp
                            <div style="background-color: {{ $backgroundColor }}; color:white; padding:0 10px; border-radius:5px;">
                                {{ $status }}
                            </div>
                        </li>
                        @endif

                        @if($user->account_type == 2)
                        <li>
                            <div><strong>To activate your business account or update your business information, click on "Info" under "My Business" menu, or <a href="{{ route('business-info.index') }}">click here</a>.</strong></div>
                        </li>
                        @endif

                        @if($user->account_type == 3)
                        <li>
                            <div><strong>To activate your organization's account or update your organization information, fill all info below and wait for admin approval.</strong></div>
                        </li>
                        @endif

                        @if($user->account_type == 4)
                        <li>
                            <div><strong>If you want to change your candidate profile or update personal info, click "Info" under "My Profile", or <a href="{{ route('candidate-info.index',$user->id) }}">click here</a>.</strong></div>
                        </li>
                        @endif
                    </ul>
                </div>

                @if($user->account_type == 3)
                <!-- NGO Main Info -->
                <div class="account-card">
                    <div class="account-title">
                        <h3>NGO Main Info</h3><a href="{{ route('ngo.other') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li><h5>NGO Name:</h5><p>{{ $ngoInfo?->ngo_name }}</p></li>
                        <li><h5>Category:</h5><p>{{ $ngoInfo?->category?->name ?? '' }}</p></li>
                        <li><h5>Logo:</h5>
                            <p><img src="{{ asset($ngoInfo?->logo_path ? 'storage/'.$ngoInfo->logo_path : 'storage/no-image.jpg') }}" style="width:100px; height:100px;"></p>
                        </li>
                    </ul>
                </div>

                <!-- NGO Info -->
                <div class="account-card">
                    <div class="account-title">
                        <h3>NGO Info</h3><a href="{{ route('ngoInfo') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li><h5>Establishment:</h5><p>{{ $ngoInfo?->establishment }}</p></li>
                        <li><h5>ABN:</h5><p>{{ $ngoInfo?->abn }}</p></li>
                        <li><h5>ACNC:</h5><p>{{ $ngoInfo?->acnc }}</p></li>
                        <li><h5>GST:</h5><p>{{ $ngoInfo?->gst }}</p></li>
                        <li><h5>Size:</h5><p>{{ ucfirst($ngoInfo?->size) }}</p></li>
                    </ul>
                </div>

                <!-- NGO Team Members -->
                <div class="account-card">
                    <div class="account-title"><h3>NGO Team Member</h3><a href="{{ route('ngo.team') }}">Edit</a></div>
                    @if($ngoMembers)
                    <ul class="account-card-list">
                        @foreach($ngoMembers as $member)
                        <li>{{ $member->name }} - {{ $member->designation }}</li>
                        @endforeach
                    </ul>
                    @else
                    <p>No members found for this NGO.</p>
                    @endif
                </div>
                @endif

                <!-- Password Updates -->
                <div class="account-card">
                    <div class="account-title"><h3>Password Updates</h3></div>
                    <form method="post" action="{{ route('user.password.update') }}" id="change-password-form">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <input id="current_password" name="current_password" type="password" class="form-control" placeholder="Current Password" required>
                        </div>
                        <div class="form-group">
                            <div class="password-container">
                                <input id="new_password" name="password" type="password" class="form-control" placeholder="New Password (min 6 characters)" required>
                                <button type="button" class="form-icon new-password-eye"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="password-container">
                                <input id="confirm_password" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required>
                                <button type="button" class="form-icon confirm-password-eye"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-inline" id="save-button"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                @if($user->account_type == 3)
                <!-- NGO Address -->
                <div class="account-card">
                    <div class="account-title"><h3>NGO Address</h3><a href="{{ route('ngo.address') }}">Edit</a></div>
                    <ul class="account-card-list">
                        <li><h5>Address:</h5><p>{{ $ngoInfo?->ngo_address }}</p></li>
                        <li><h5>City:</h5><p>{{ $ngoInfo?->ngo_city }}</p></li>
                        <li><h5>State:</h5><p>{{ $ngoInfo?->ngo_state }}</p></li>
                        <li><h5>Country:</h5><p>{{ $ngoInfo?->ngo_country }}</p></li>
                        <li><h5>Phone No.:</h5><p>{{ $ngoInfo?->contact_phone }}</p></li>
                    </ul>
                </div>

                <!-- Social Accounts -->
                <div class="account-card">
                    <div class="account-title"><h3>Social Accounts</h3><a href="{{ route('ngo.social') }}">Edit</a></div>
                    <ul class="account-card-list">
                        <li><h5>Website:</h5><p>{{ $ngoInfo?->website_url }}</p></li>
                        <li><h5>Facebook:</h5><p>{{ $ngoInfo?->facebook_url }}</p></li>
                        <li><h5>X:</h5><p>{{ $ngoInfo?->twitter_url }}</p></li>
                        <li><h5>Instagram:</h5><p>{{ $ngoInfo?->instagram_url }}</p></li>
                        <li><h5>Linkedin:</h5><p>{{ $ngoInfo?->linkedin_url }}</p></li>
                    </ul>
                </div>
                @endif

                @if($user->account_type == 1 || $user->account_type == 2)
                <!-- Billing Address -->
                <div class="account-card">
                    <div class="account-title"><h3>Billing Address</h3><a href="{{ route('billingInfo') }}">Edit</a></div>
                    <ul class="account-card-list">
                        <li><h5>Address:</h5><p>{{ $userDetail?->billing_address }}</p></li>
                        <li><h5>City:</h5><p>{{ $userDetail?->billing_city }}</p></li>
                        <li><h5>State:</h5><p>{{ $userDetail?->billing_state }}</p></li>
                        <li><h5>Country:</h5><p>{{ $userDetail?->billing_country }}</p></li>
                        <li><h5>Post Code:</h5><p>{{ $userDetail?->billing_postcode }}</p></li>
                    </ul>
                </div>

                <!-- Shipping Address -->
                <div class="account-card">
                    <div class="account-title"><h3>Shipping Address</h3><a href="{{ route('shippingInfo') }}">Edit</a></div>
                    <ul class="account-card-list">
                        <li><h5>Address:</h5><p>{{ $userDetail?->shipping_address }}</p></li>
                        <li><h5>City:</h5><p>{{ $userDetail?->shipping_city }}</p></li>
                        <li><h5>State:</h5><p>{{ $userDetail?->shipping_state }}</p></li>
                        <li><h5>Country:</h5><p>{{ $userDetail?->shipping_country }}</p></li>
                        <li><h5>Post Code:</h5><p>{{ $userDetail?->shipping_postcode }}</p></li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
 
@push('scripts')
    <script src="{{ asset('admin_assets/js/select2.full.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.new-password-eye').on('click', function () {
                const inputField = $('#new_password');
                const inputType = inputField.attr('type') === 'password' ? 'text' : 'password';
                inputField.attr('type', inputType);
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });

            $('.confirm-password-eye').on('click', function () {
                const inputField = $('#confirm_password');
                const inputType = inputField.attr('type') === 'password' ? 'text' : 'password';
                inputField.attr('type', inputType);
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });

            $('#confirm_password').on('input', function () {
                const newPassword = $('#new_password').val();
                const confirmPassword = $(this).val();
                const statusSpan = $('#password-status');

                if (!newPassword) {
                    statusSpan.text("New Password can't be blank.").css('color', 'red').show();
                } else if (newPassword.length < 6) {
                    statusSpan.text('New Password must be at least 6 characters long.').css('color', 'red').show();
                } else if (newPassword !== confirmPassword) {
                    statusSpan.text('Passwords do not match.').css('color', 'red').show();
                } else {
                    statusSpan.text('Passwords match!').css('color', 'green').show();
                }
            });

            $('#change-password-form').submit(function (e) {
                e.preventDefault();

                const newPassword = $('#new_password').val();
                const confirmPassword = $('#confirm_password').val();
                const statusSpan = $('#password-status');
                const $submitButton = $('#save-button');

                if (!newPassword || newPassword.length < 6) {
                    toastr.error('New Password must be at least 6 characters long.');
                    return;
                }

                if (newPassword !== confirmPassword) {
                    statusSpan.text('Passwords do not match.').css('color', 'red').show();
                    $('#confirm_password').focus();
                    return;
                }

                $submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

                const formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message || 'Password updated successfully!');
                            $('#change-password-form')[0].reset();
                            statusSpan.hide();
                        } else {
                            toastr.error(response.message || 'Failed to update password.');
                        }
                        $submitButton.prop('disabled', false).html('<i class="fas fa-save"></i> Save');
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON;
                        if (errors && errors.errors) {
                            for (const field in errors.errors) {
                                toastr.error(errors.errors[field][0]);
                            }
                        } else if (errors && errors.message) {
                            toastr.error(errors.message);
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                        $submitButton.prop('disabled', false).html('<i class="fas fa-save"></i> Save');
                    }
                });
            });



        });


    </script>
@endpush

    
@endsection