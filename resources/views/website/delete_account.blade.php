@extends('frontend.template.master')
@section('title', 'Delete Account')
@section('description', 'Delete your account from Eversubz')
@section('content')

<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Delete Account</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Delete Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-content" style="margin-top:50px;">
                    <h4>Requesting Account Deletion</h4>
                
                    <p>We're sorry to see you go! Deleting your account means you will lose access to all your data and services.</p><br />
                
                    <form action="{{ route('account.delete') }}" method="POST" id="delete-account-form">
                        @csrf
                    
                        <div class="form-group">
                            <label for="email">Enter Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="password">Enter Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    
                        <p><b>Note:</b> Once you submit a deletion request, your account will be permanently deleted in the next 7 days.</p>
                    
                        <button style="margin:20px 0 100px 0px" type="button" class="btn btn-sm btn-danger" id="delete-account-button">
                            Agree & Delete Account
                        </button>
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#delete-account-button').on('click', function (e) {
            e.preventDefault();

            const email = $('input[name="email"]').val().trim();
            const password = $('input[name="password"]').val().trim();

            if (!email) {
                toastr.error('Please enter your email address.');
                return;
            }

            if (!password) {
                toastr.error('Please enter your password.');
                return;
            }

            if (confirm('Are you sure you want to delete your account? This action is irreversible.')) {
                const form = $('#delete-account-form');
                const formData = form.serialize();
                const actionUrl = form.attr('action');

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message || 'Your account has been deleted.');
                            setTimeout(function () {
                                window.location.href = response.redirect || '/';
                            }, 2000);
                        } else {
                            toastr.error(response.message || 'Failed to delete your account. Please try again.');
                        }
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
                            toastr.error('An unexpected error occurred. Please try again.');
                        }
                    }
                });
            }
        });
    });


</script>
@endpush

@endsection