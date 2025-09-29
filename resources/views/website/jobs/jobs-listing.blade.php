@extends('frontend.template.master')


@section('title', 'Explore Exciting Job Opportunities | Eversabz Job Listings')
@section('description', 'Explore diverse job opportunities with Eversabz. Find your perfect career match and apply
    today. Start your journey towards a fulfilling professional future!')

@section('content')

    @push('style')
        <style>
            .single-banner {
                margin-bottom: 0px;
            }

            .main-section2 {
                background: #F9FAFB !important;
                padding: 80px 0 80px;
            }

            .product-widget {
                padding: 5px 10px;
                background: #ffffff;
                margin-bottom: 0px;
                border: 1px solid #f3f3f3;
            }

            .form-control {
                height: 40px;
                border-radius: 6px;
                width: 100%;
                background: var(--white);
                border: 1px solid #eeeeee;
            }

            .product-widget-title {

                margin: 0;
                border: none;
                font-size: 13px;
                text-transform: capitalize;
                padding: 6px 0px;

            }

            .filter-list li {
                font-size: 12px;
            }

            .form-check-input {
                position: inherit;
                margin-top: 0px;
                margin-left: 0px;
                margin-right: 5px;
            }

            .col-lg-8.col-xl-8 {
                padding: 0px 5px;
            }

            .col-xl-4.col-lg-6.col-md-6.col-6 {
                padding: 0px 5px;
                margin-bottom: 1.3rem;
            }

            .header-filter {
                display: block;
                margin-bottom: 0px;
            }

            .header-filter form {
                justify-content: space-between;
            }

            .job-instructor-layout {
                background: #ffffff;
                position: relative;
                display: block;
                transition: all ease 0.4s;
                border-radius: 8px;

            }

            .job-instructor-layout:hover {
                background: var(--white);
                box-shadow: 0 10px 25px 0 rgb(0 0 0 / .1);
            }

            .job-instructor-thumb a {
                overflow: hidden;
            }

            .job-instructor-layout:hover .job-instructor-thumb img {
                transform: scale(1.08);
            }


            .left-tags-capt {
                top: 10px;
                left: 0;
                position: absolute;
                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical !important;
                -webkit-box-direction: normal !important;
                -webkit-webkit-direction: normal !important;
                -ms-flex-direction: column !important;
                -webkit-flex-direction: column !important;
                flex-direction: column !important;
            }

            .left-tags-capt>span {
                border-radius: 0 40px 40px 0 !important;
                margin-bottom: 0.6rem;
            }

            .featured-text {
                display: inline-block;
                color: #009667;
                background: rgb(0 150 103 / 15%);
                padding: 3px 15px;
                font-size: 12px;
            }

            .urgent {
                display: inline-block;
                color: #ff8222;
                background: rgb(255 130 34 / 15%);
                padding: 3px 15px;
                font-size: 12px;
            }

            .job-instructor-layout .brows-job-type span {
                position: absolute;
                padding: 4px 15px;
                top: 15px;
                right: 10px;
                line-height: 1.4;
                font-size: 11px;
                border-radius: 0.3rem;
                font-weight: 500;
            }

            .full-time {
                background: rgba(3, 165, 4, 0.1);
                color: #03a504;
            }

            .enternship {
                background: rgba(210, 0, 1, 0.1);
                color: #d20001;
            }

            .part-time {
                background: rgb(90 84 255 / 11%);
                color: #5a54ff;
            }

            .freelanc {
                background: rgba(38, 169, 225, 0.1);
                color: #26a9e1;
            }

            a {
                color: #000;
            }

            .job-instructor-thumb {
                display: table;
                text-align: center;
                width: 100%;
                /* padding: 50px 0px 0px; */
                margin: 0 auto;
                border-radius: 8px;
            }

            .job-instructor-thumb img {
                display: table;
                margin: 0 auto;
                width: 100%;
                height: 160px;
                transition: .5s linear;
            }

            .job-instructor-content {
                position: relative;
                padding: 0px 5px;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                flex-direction: column;
                width: 100%;
                text-align: center;
                min-height: 80px;
            }

            .jbs-job-employer-wrap {
                position: relative;
                width: 100%;
            }

            .jbs-job-employer-wrap span {
                font-weight: 500;
                color: #000;
                font-size: 13px;
            }

            .instructor-title {
                line-height: 1.5;
                font-size: 15px;
                margin: 0;
            }

            .text-sm-muted {
                font-size: 12px;
                font-weight: 500;
                color: #000;
            }

            .jbs-grid-job-edrs-group {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                flex-flow: wrap;
                /*height: 60px;*/
                height: auto;
            }

            .jbs-grid-job-edrs-group span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                height: 23px;
                width: auto;
                padding: 2px 10px;
                border-radius: 0.2rem;
                background: #f3f6fa;
                color: #000;
                font-weight: 500;
                font-size: 11px;
                margin-right: 7px;
                margin-top: 4px;
                margin-bottom: 4px;
            }

            .jbs-grid-job-apply-btns {
                position: relative;
                width: 100%;
            }

            .jbs-btn-groups {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
            }

            .jbs-grid-package-title.smalls h5 {
                font-size: 14px;
                margin: 0;
                color: #000;
            }

            .jbs-grid-package-title h5 span {
                font-size: 14px;
                font-weight: 500;
                color: #000;
            }

            .jbs-sng-blux .btn-light-primary {
                background: rgba(28, 167, 116, 0.12);
                border-color: rgba(28, 167, 116, 0.2);
                color: #000;
                padding: 10px 3px;
                font-size: 9px;
            }

            .jbs-sng-blux .btn-light-primary:hover {
                background: #1ca774 !important;
                border-color: #1ca774 !important;
                color: #ffffff !important;
            }

            .range-container {
                position: relative;
                width: 100%;
                margin-top: 15px;
            }

            .form-range {
                width: 100%;
                cursor: pointer;
            }

            .slider-value {
                position: absolute;
                top: -20px;
                left: 50%;
                transform: translateX(10%);
                font-size: 14px;
                font-weight: bold;
                color: #000;
            }

            .range-labels {
                font-size: 10px;
                margin-top: -10px;

                width: 100%;
                display: flex;
                justify-content: space-between;
            }

            .col-lg-4.col-xl-3 {
                padding: 6px;
            }

            .ssh-header a:hover {
                color: #2A6EB5 !important;
                border-bottom: 4px solid #2A6EB5;
                font-weight: 700;
            }

            #signup-form {
                background: white;
                padding: 40px;
                border-radius: 22px;
            }

            .custom-input {
                border-radius: 10px;
                padding: 10px 15px;
                height: 56px;
                font-size: 14px;
                background-color: #fff;
                border: 1px solid #2e6ab3;
                font-weight: 500;
            }


            .custom-input1 {
                padding: 10px 15px;
                height: 56px;
                font-size: 14px;
                background-color: #f2f6fa;
                font-weight: 500;
            }

            .email_not_verified {
                font-size: 18px;
                color: #dc2626;
                /* red-600 */
                font-weight: 600;
                margin-bottom: 12px;
                text-align: center;
            }

            .verify-btn {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
                /* blue gradient */
                color: #ffffff;
                border: none;
                padding: 12px 24px;
                font-size: 16px;
                font-weight: 600;
                border-radius: 8px;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                display: block;
                margin: 0 auto;
            }

            .verify-btn:hover {
                background: linear-gradient(135deg, #1d4ed8, #1e40af);
                /* darker blue */
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            }

            .register-btn {
                background: linear-gradient(135deg, #2c54a4, #28a745);
                padding: 38px;
                height: 47px;
            }

            .position-absolute {
                position: absolute !important;
                right: 12px;
                top: 14px;
            }

            .main-section2 {
                background: #f1f5f8 !important;
                padding: 70px 0 70px;
            }

            @media only screen and (max-width: 767px) {
                .col-lg-8.col-xl-8 {
                    padding: 0px 15px;

                }

                .job-instructor-thumb img {
                    display: table;
                    margin: 0 auto;
                    width: 100%;
                    height: 100%;
                }

                .instructor-title {
                    font-size: 13px;
                }
            }

            .mob-pad-0 {
                max-width: 750px;
                /* Set fixed width */
                width: 100%;
                padding: 20px;
                background: #ffffff;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
            }
        </style>
    @endpush
    <section class="inner-section single-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2>jobs List</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Jobs List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="main-section2">
        <div class="container">
            @if (Auth::check())
                @if (Auth::user()->hasVerifiedEmail())
                    @if (Auth::user()->is_admin_approved == 1)
                        <div class="row">
                            <!-- Sidebar Filters -->
                            <div class="col-lg-4 col-xl-3">
                                <div class="bg-white rounded mb-3">
                                    <div class="col-lg-12 text-center">
                                        <a href="#" class="btn btn-new-one">Add Job Post</a>
                                    </div>
                                    <div class="sidebar_header d-flex align-items-center justify-content-between px-4 py-3 br-bottom">
                                        <h4 class="fs-bold fs-5 mb-0">Search Filter</h4>
                                        <div class="ssh-header">
                                            <a href="{{ route('jobs.list') }}" class="clear_all ft-medium text-muted">Clear All</a>
                                        </div>
                                    </div>
                                    <div>
                                        <form method="GET" action="{{ route('jobs.list') }}">
                                            <!-- Keyword Search -->
                                            <div class="filter-search-box px-2 pt-2">
                                                <div class="form-group">
                                                    <input type="text" name="keyword" class="form-control"
                                                        placeholder="Search by keywords..." value="{{ request('keyword') }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="location" class="form-control"
                                                        placeholder="City, State, Country..." value="{{ request('location') }}">
                                                </div>
                                            </div>
        
                                            <!-- Job Categories -->
                                            <x-filter-section title="Job Categories" :items="$categories" inputName="categories"
                                                keyName="name" />
        
                                            <!-- Skills -->
                                            <x-filter-section title="Skills" :items="$skills" inputName="skills"
                                                keyName="skill_name" />
        
                                            <!-- Tags -->
                                            <x-filter-section title="Tags" :items="$tags" inputName="tags"
                                                keyName="tag_name" />
        
                                            <!-- Experience -->
                                            <x-filter-section title="Experience" :items="array_map(
                                                function ($key, $value) {
                                                    return ['id' => $key, 'name' => $value];
                                                },
                                                array_keys(config('jobs.experience_levels')),
                                                config('jobs.experience_levels'),
                                            )" inputName="experiences[]"
                                                keyName="name" />
        
                                            <!-- Job Types -->
                                            <x-filter-section title="Job Type" :items="array_map(
                                                function ($key, $value) {
                                                    return ['id' => $key, 'name' => $value];
                                                },
                                                array_keys(config('jobs.job_modes')),
                                                config('jobs.job_modes'),
                                            )" inputName="job_types[]"
                                                keyName="name" />
        
                                            <!-- Submit Button -->
                                            <div class="form-group filter_button pt-1 pb-1 px-2">
                                                <button type="submit" class="product-widget-btn">Search job</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Job Listings -->
                            <div class="col-lg-8 col-xl-9">
                                <div class="row">
                                    @forelse ($jobs as $job)
                                        <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                                            <x-job-card :job="$job" />
                                        </div>
                                    @empty
                                        <p>No jobs found.</p>
                                    @endforelse
                                </div>
        
                                <!-- Pagination Links -->
                                <div class="mt-4">
                                    {{ $jobs->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Profile not approved message --}}
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <div class="alert alert-warning" role="alert">
                                    <div class="mb-3">
                                        <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                                    </div>
                                    <h4 class="alert-heading">Profile Pending Approval</h4>
                                    <p class="mb-0">
                                        Your profile is currently under review by our administrators. 
                                        You'll be able to access job listings once your profile has been approved.
                                    </p>
                                    <hr>
                                    <p class="mb-0 small text-muted">
                                        This process typically takes 24-48 hours. You'll receive an email notification once approved.
                                    </p>
                                </div>
                                
                                <div class="mt-4">
                                    <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">
                                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                                    </a>
                                    <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-user-edit"></i> Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    {{-- Email verification section - keep existing code --}}
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-green-500">A new verification link has been sent to your email address.</p>
                    @endif
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p class="email_not_verified">Your email address hasn't been verified yet.</p>
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="text-blue-500 verify-btn">
                                    Click here to verify your email
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @else
                {{-- Registration form for non-authenticated users - keep existing code --}}
                <div class="row justify-content-center">
                <div class="mob-pad-0">
                    <form action="{{ route('register') }}" method="POST" id="signup-form">
                        <h5 class="mb-4 mob-center text-center">Please log in to view Jobs listings and details.</h5>
                        @csrf
                        <div class="mb-3 position-relative">
                            <input type="text" class="form-control custom-input1" placeholder="Name" name="name"
                                    required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="text" class="form-control custom-input1" placeholder="Username" name="username"
                                    required>
                        </div>
                        <!-- <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <input type="text" class="form-control custom-input1" placeholder="Name" name="name"
                                    required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control custom-input1" placeholder="Username" name="username"
                                    required>
                            </div>
                        </div> -->
                        <div class="mb-3">
                            <input type="email" class="form-control custom-input1" placeholder="Business email" name="email"
                                required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" class="form-control custom-input1" placeholder="Password" id="password"
                                name="password" required>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;"
                                onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" class="form-control custom-input1" placeholder="Confirm Password"
                                id="password_confirmation" name="password_confirmation" required>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;"
                                onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>

                        <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="signup_check" name="signup_check" required>
                        <label class="form-check-label small" for="signup_check">
                            By creating this account you accept our 
                            <a href="{{ asset('terms-of-use') }}">Terms of Use</a> 
                            and <a href="{{ asset('privacy-policy') }}">Privacy Policy</a>
                        </label>
                    </div>
                        <input type="hidden" name="account_type" value="4">
                        <div class="mb-3">
                            <div id="signup-error" class="text-danger" style="display: none;"></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 register-btn">
                            Register Now
                            <span class="spinner-border spinner-border-sm" style="display: none;"></span>
                        </button>
                        <p class="text-center mt-3 small">Already have a Account? <a href="{{ route('user.login') }}">Log in</a>
                        </p>
                    </form>
                </div>
            </div>
            @endif
        </div>
        

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#signup-form').on('submit', function(e) {
                e.preventDefault();

                const $button = $('#signup-btn');
                const $loader = $button.find('.spinner-border');
                const $errorDiv = $('#signup-error');

                $button.prop('disabled', true);
                $loader.show();
                $errorDiv.hide();

                const formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $errorDiv.removeClass('text-danger').addClass('text-success').text(
                                response.message).show();
                            setTimeout(() => {
                                window.location.href = response.redirect;
                            }, 1000);
                        } else {
                            $errorDiv.text(response.message).show();
                            $button.prop('disabled', false);
                            $loader.hide();
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Registration failed. Please try again.';
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            errorMessage = Object.values(errors).flat().join(' ');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $errorDiv.text(errorMessage).show();
                        $button.prop('disabled', false);
                        $loader.hide();
                    }
                });
            });

            function togglePassword(fieldId) {
                const passwordField = $('#' + fieldId);
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                const icon = passwordField.next('span').find('i');
                icon.toggleClass('fa-eye fa-eye-slash');
            }
        });
    </script>

    <script>
        const rangeSlider = document.getElementById('rangeSlider');
        const sliderValue = document.getElementById('sliderValue');

        function updateSliderValue() {
            const value = rangeSlider.value;
            sliderValue.textContent = value;

            const percentage = (value - rangeSlider.min) / (rangeSlider.max - rangeSlider.min) * 100;
            sliderValue.style.left = `calc(${percentage}% - 15px)`;
        }

        updateSliderValue();

        rangeSlider.addEventListener('input', updateSliderValue);
    </script>

@endsection
