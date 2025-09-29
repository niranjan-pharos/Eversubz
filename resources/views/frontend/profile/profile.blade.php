@extends('frontend.template.master')
@section('title',  "My Profile")

@section('content') 
@include('frontend.template.usermenu')


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


</style>

<section class="profile-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">

                <div class="account-card">
                    <div class="account-title">
                        <h3>Basic Info</h3>
                        <a href="{{ route('basicInfo') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">

                        <li>
                            <h5>Name:</h5>
                            <p>{{ $user->name }}</p>
                        </li>
                        <li>
                            <h5>User Id:</h5>
                            <p>{{ $user->uid }}</p>
                        </li>
                        <li>
                            <h5>Username:</h5>
                            <p>{{ $user->username }}</p>
                        </li>
                        <li>
                            <h5>Email:</h5>
                            <p>{{ $user->email }}</p>
                        </li>
                        <li>
                            <h5>Phone:</h5>
                            <p>+{{ $user->phone }}</p>
                        </li>

                        {{-- <li>
                            <h5>Company:</h5>
                            <p>{{ $businessDetail?->business_name }}</p>
                        </li>

                        <li>
                            <h5>Website:</h5>
                            <p>
                                <a href="{{ $businessDetail?->website_url }}" target="_blank">{{
                                    $businessDetail?->website_url
                                    }}</a>
                            </p>
                        </li> --}}
                        <li>
                            <h5>Account Type</h5>
                            <p>{{ $acc_type }}</p>
                        </li>
                        @if($user->account_type == 2)
                        <li>
                            <h5>Business A/c. Status</h5>
                            @php
                            $status = '';
                            $backgroundColor = '';

                            switch ($user->account_type) {
                            case 2: // Business account type
                            if ($user->is_admin_approved == 1) {
                            $status = 'Enable';
                            $backgroundColor = 'green';
                            } else {
                            $status = 'Pending';
                            $backgroundColor = 'orange';
                            }
                            break;
                            default:
                            $status = 'Disable';
                            $backgroundColor = 'gray';
                            break;
                            }
                            @endphp

                            <div
                                style="background-color: {{ $backgroundColor }}; color: white; padding: 0px 10px; border-radius: 5px;">
                                {{ $status }}
                            </div>
                        </li>
                        @endif
                        @if($user->account_type == 3)
    <li>
        <h5>Business A/c. Status</h5>
        @php
        $status = '';
        $backgroundColor = '';

        switch ($user->account_type) {
            case 3: // Handle account type 3
                if ($user->is_admin_approved == 1) {
                    $status = 'Enable';
                    $backgroundColor = 'green';
                } else {
                    $status = 'Pending';
                    $backgroundColor = 'orange';
                }
                break;
            default:
                $status = 'Disable';
                $backgroundColor = 'gray';
                break;
        }
        @endphp

        <div
            style="background-color: {{ $backgroundColor }}; color: white; padding: 0px 10px; border-radius: 5px;">
            {{ $status }}
        </div>
    </li>
@endif

                        @if($user->account_type == 2)
                        <li>
                            <div>
                               <strong>To activate your business account or update your business
                                    information, click on "Info" under the "My Business" menu, or <a
                                        href="{{ route('business-info.index') }}">click here</a>.</strong>
                            </div>
                        </li>
                        @endif

                        @if($user->account_type == 3)
                        <li>
                            <div>
                            <strong>   To activate your organization's account or update your organization
                                    information, please fill below all information and wait for admin approval.  </strong>
                            </div>
                        </li>
                        @endif
                        @if($user->account_type == 4) 
                        <li>
                            <div>
                            <strong>   If you want to change your candidate profile or update your personal information, click on "Info" under the "My Profile" menu, or <a href="{{ route('candidate-info.index',$user->id) }}">click here</a>.</strong>
                            </div>
                        </li>
                        @endif

                    </ul>
                </div>
                @if($user->account_type == 3)
                <div class="account-card ">
                    <div class="account-title">
                        <h3>NGO Main Infoo</h3><a href="{{ route('ngo.other') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li>
                            <h5>NGO Name:</h5>
                            <p>{{ $ngoInfo?->ngo_name }}</p>
                        </li>
                        <li>
                            <h5>Category:</h5>
                            <p>{{ $ngoInfo?->category?->name ?? '' }}</p>
                        </li>
                        <li>
                            <h5>Logo:</h5>
                            <p>
                                <img src="{{ asset($ngoInfo?->logo_path ? 'storage/'.$ngoInfo->logo_path : 'storage/no-image.jpg') }}"
                                    style="width:100px; height:100px;">
                            </p>

                        </li>

                    </ul>
                </div>
                <div class="account-card">
                    <div class="account-title">
                        <h3>NGO Info</h3><a href="{{ route('ngoInfo') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">

                        <li>
                            <h5>Establishment:</h5>
                            <p>{{ $ngoInfo?->establishment }}</p>
                        </li>

                        <li>
                            <h5>ABN:</h5>
                            <p>{{ $ngoInfo?->abn }}</p>
                        </li>

                        <li>
                            <h5>ACNC:</h5>
                            <p>{{ $ngoInfo?->acnc }}</p>
                        </li>
                        <li>
                            <h5>GST:</h5>
                            <p>{{ $ngoInfo?->gst }}</p>
                        </li>
                        <li>
                            <h5>Size:</h5>
                            <p>{{ ucfirst($ngoInfo?->size) }}</p>
                        </li>
                    </ul>
                </div>
                <div class="account-card">
                    <div class="account-title">
                        <h3>NGO Team Member</h3><a href="{{ route('ngo.team') }}">Edit</a>
                    </div>
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


                <div class="account-card ">
                    <div class="account-title">
                        <h3>Password Updates</h3>
                    </div>
                    <form method="post" action="{{ route('user.password.update') }}" id="change-password-form">
                        @csrf
                        @method('put')
                    
                        <div class="form-group">
                            <input id="current_password" name="current_password" type="password" class="form-control"
                                placeholder="Current Password" required>
                        </div>
                    
                        <div class="form-group">
                            <div class="password-container">
                                <input id="new_password" name="password" type="password" class="form-control"
                                    placeholder="New Password (min 6 characters)" required>
                                <button type="button" class="form-icon new-password-eye">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <div class="password-container">
                                <input id="confirm_password" name="password_confirmation" type="password" class="form-control"
                                    placeholder="Confirm Password" required>
                                <button type="button" class="form-icon confirm-password-eye">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <span id="password-status" style="display: none; font-size: 0.9em;"></span>
                        </div>
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-inline" id="save-button">
                                <i class="fas fa-save"></i> Save
                            </button>
                        </div>
                    </form>
                    
                    
                    
                </div>


            </div>

            <div class="col-lg-6">
                @if($user->account_type == 3)

                <div class="account-card">
                    <div class="account-title">
                        <h3>NGO Address</h3><a href="{{ route('ngo.address') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li>
                            <h5>Address:</h5>
                            <p>{{ $ngoInfo?->ngo_address }}</p>
                        </li>
                        <li>
                            <h5>City:</h5>
                            <p>{{ $ngoInfo?->ngo_city }}</p>
                        </li>

                        <li>
                            <h5>State:</h5>
                            <p>{{ $ngoInfo?->ngo_state }}</p>
                        </li>

                        <li>
                            <h5>Country:</h5>
                            <p>{{ $ngoInfo?->ngo_country }}</p>
                        </li>
                        <li>
                            <h5>Phone No.:</h5>
                            <p>{{ $ngoInfo?->contact_phone }}</p>
                        </li>
                    </ul>
                </div>
                <div class="account-card">
                    <div class="account-title">
                        <h3>Social Accounts</h3><a href="{{ route('ngo.social') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li>
                            <h5>Website:</h5>
                            <p>{{ $ngoInfo?->website_url }}</p>
                        </li>
                        <li>
                            <h5>Facebook:</h5>
                            <p>{{ $ngoInfo?->facebook_url }}</p>
                        </li>

                        <li>
                            <h5>X:</h5>
                            <p>{{ $ngoInfo?->twitter_url }}</p>
                        </li>

                        <li>
                            <h5>Instagram:</h5>
                            <p>{{ $ngoInfo?->instagram_url }}</p>
                        </li>
                        <li>
                            <h5>Linkedin:</h5>
                            <p>{{ $ngoInfo?->linkedin_url }}</p>
                        </li>
                    </ul>
                </div>

                

                @endif
                @if($user->account_type == 1 || $user->account_type == 2)
                <div class="account-card">
                    <div class="account-title">
                        <h3>Billing Address</h3><a href="{{ route('billingInfo') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li>
                            <h5>Address:</h5>
                            <p>{{ $userDetail?->billing_address }}</p>
                        </li>
                        <li>
                            <h5>City:</h5>
                            <p>{{ $userDetail?->billing_city }}</p>
                        </li>

                        <li>
                            <h5>State:</h5>
                            <p>{{ $userDetail?->billing_state }}</p>
                        </li>

                        <li>
                            <h5>Country:</h5>
                            <p>{{ $userDetail?->billing_country }}</p>
                        </li>
                        <li>
                            <h5>Post Code:</h5>
                            <p>{{ $userDetail?->billing_postcode }}</p>
                        </li>
                    </ul>
                </div>
                <div class="account-card">
                    <div class="account-title">
                        <h3>Shipping Address</h3><a href="{{ route('shippingInfo') }}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li>
                            <h5>Address:</h5>
                            <p>{{ $userDetail?->shipping_address }}</p>
                        </li>
                        <li>
                            <h5>City:</h5>
                            <p>{{ $userDetail?->shipping_city }}</p>
                        </li>

                        <li>
                            <h5>State:</h5>
                            <p>{{ $userDetail?->shipping_state }}</p>
                        </li>

                        <li>
                            <h5>Country:</h5>
                            <p>{{ $userDetail?->shipping_country }}</p>
                        </li>
                        <li>
                            <h5>Post Code:</h5>
                            <p>{{ $userDetail?->shipping_postcode }}</p>
                        </li>
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