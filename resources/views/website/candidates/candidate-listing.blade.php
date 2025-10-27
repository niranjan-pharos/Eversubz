@extends('frontend.template.master')
@section('title', 'Explore Top Talent: Browse Our Comprehensive Candidates Listing | Eversabz')
@section('description', 'Explore a diverse range of job candidates on Eversabz. Find the perfect match for your hiring needs with our comprehensive candidate listings.')
@section('content')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
   .main-section2 {
   background: #f1f5f8 !important;
   padding: 70px 0 70px;
   }
   .form-control {
   height: 40px;
   border-radius: 6px;
   width: 100%;
   background: var(--white);
   border: 1px solid #eeeeee;
   }
   .product-widget {
   padding: 5px 10px;
   background: #ffffff;
   margin-bottom: 20px;
   border: 1px solid #f3f3f3;
   }
   .product-widget-title {
   margin: 0;
   border: none;
   font-size: 13px;
   text-transform: capitalize;
   padding: 6px 0px;
   }
   .product-widget-title a{display: flex;
   justify-content: space-between;
   color: #000;}
   .filter-list li {
   font-size: 12px;
   }
   .filter-list li input {
   position: inherit;
   margin-top: 0px;
   margin-left: 0px;
   margin-right: 5px;
   }
   .single-banner {
   margin-bottom: 0px;
   }
   .jbs-grid-usrs-block {
   background: #ffffff;
   position: relative;
   display: block;
   transition: all ease 0.4s;
   border-radius: 8px;
   padding-top: 7px;
   }
   .jbs-grid-usrs-block:hover {
   background: var(--white);
   box-shadow: 0 10px 25px 0 rgb(0 0 0 / .1);
   }
   .jbs-grid-usrs-block:hover .jbs-grid-usrs-thumb img {
   transform: scale(1.08);
   }
   .jbs-grid-usrs-thumb {
   display: table;
   text-align: center;
   width: 100%;
   margin: 0 auto;
   border-radius: 8px;
   }
   .jbs-grid-usrs-thumb a{overflow:hidden;}
   .jbs-grid-usrs-thumb img{     transition: .5s linear; display: table;
   margin: 0 auto;
   width: 100%;
   height: 100%}
   .jbs-grid-yuo {
   display: flex
   ;
   align-items: center;
   justify-content: center;
   width: 100px;
   height: 100px;
   border-radius: 50%;
   margin: 0 auto;
   }
   .jbs-grid-yuo figure {
   margin: 0;
   }
   .circle {
   border-radius: 100%;
   }
   .jbs-grid-usrs-caption {
   position: relative;
   width: 100%;
   display: flex
   ;
   flex-direction: column;
   align-items: center;
   justify-content: center;
   margin: 10px auto 0.5rem;
   }
   .jbs-grid-usrs-caption h4{font-size: 19px;
   margin: 0;
   line-height: 1.5;}
   .jbs-grid-usrs-caption span {
   font-size: 15px;
   font-weight: 500;
   color: #000000a8;
   }
   .jbs-tiosk {
   position: relative;
   display: flex
   ;
   flex-direction: column;
   align-items: center;
   justify-content: center;
   width: 100%;
   }.jbs-tiosk .jbs-tiosk-title {
   font-size: 17px;
   margin: 0;
   line-height: 1.5;
   }.jbs-tiosk .jbs-tiosk-subtitle {
   font-size: 12px;
   font-weight: 500;
   color: rgba(0, 44, 63, 0.6);
   }
   .jbs-grid-job-edrs span {
   display: inline-flex;
   align-items: center;
   justify-content: center;
   height: 23px;
   width: auto;
   padding: 2px 10px;
   border-radius: 0.2rem;
   background: #f3f6fa;
   color: #6a828f;
   font-weight: 500;
   font-size: 11px;
   margin-right: 7px;
   margin-top: 4px;
   margin-bottom: 4px;
   }.jbs-grid-job-edrs {
   align-items: center;flex-flow: wrap;
   justify-content: center;    display: flex
   ;
   }
   .col-lg-8.col-xl-8 {
   padding: 0px 5px;
   }
   .jbs-grid-usrs-info {
   padding: 1rem !important;
   position: relative;
   display: flex;
   align-items: center;
   justify-content: center;
   width: 100%;
   }
   .jbs-info-ico-style {
   position: relative;
   display: flex
   ;
   align-items: center;
   justify-content: space-between;
   width: 100%;
   /* max-width: 400px; */
   }.jbs-info-ico-style.bold .jbs-single-y1 {
   font-weight: 600;
   color: #000;    font-size: 12px;}
   .jbs-info-ico-style .jbs-single-y1.style-2 span {
   background: rgb(0 68 187 / 15%);
   box-shadow: 0 0 0 4px rgb(0 68 187 / 25%);
   color: #0044bb;
   }
   .jbs-info-ico-style .jbs-single-y1.style-3 span {
   background: rgb(230 39 86 / 15%);
   box-shadow: 0 0 0 4px rgb(230 39 86 / 25%);
   color: #e62756;
   }
   .jbs-info-ico-style .jbs-single-y1 span {
   position: relative;
   display: inline-flex;
   width: 18px;
   height: 18px;
   align-items: center;
   justify-content: center;
   border-radius: 50%;
   font-size: 12px;
   background: red;
   box-shadow: 0 0 0 4px rgba(2, 2, 2, 0.8);
   margin-right: 10px;
   }
   .jbs-btn-groups {
   position: relative;
   display: flex
   ;
   align-items: center;
   justify-content: space-between;
   width: 100%;
   }.jbs-btn-groups .btn-gray {
   background: #f1f5f8;
   border-color: #f1f5f8;
   color: #000;
   }.jbs-btn-groups .btn-primary {
   background: #c0d1f0;
   border-color: #1ca774;
   color: var(--primary);
   border: 1px solid;
   }
   .jbs-btn-groups .btn-md {
   padding: 1em 1.5em;
   height: 45px;
   font-size: 10px;
   display: inline-flex;
   align-items: center;
   justify-content: center;
   cursor: pointer;
   -webkit-transition: all ease 0.4s;
   -o-transition: all ease 0.4s;
   transition: all ease 0.4s;
   border-radius: 0.4rem;
   }.col-lg-4.col-xl-3 {
   padding: 0px;
   }
   .col-xl-4.col-lg-6.col-md-6 {
   padding: 0px 5px;margin-bottom: 1.3rem;
   }
   a{color:#000;}
   .form-1 {
   padding: 20px 20px 30px 20px;
   background: white;
   border-radius: 10px;
   }
   .padding-left-50{
   padding-left:50px;
   }
   .jbs-grid-usrs-thumb {
   width: 100%;
   height: 250px;
   overflow: hidden;
   display: flex;
   justify-content: center;
   border-radius: 0 !important;
   }
   .jbs-grid-usrs-thumb img {
   height: 100%;
   width: auto;
   object-fit: cover;
   border-radius: 0 !important;
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
      font-weight:500;
   }
   .btn-primary {
      background-color: #3e8ef7;
      border-color: #3e8ef7;
      border-radius: 10px;
      font-weight: bold;
   }

   .btn-primary:hover {
      background-color: #227be0;
      border-color: #227be0;
   }

   .social-btn {
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 10px;
      border-radius: 10px;
      transition: all 0.3s ease-in-out;
   }

   .social-btn:hover {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
   }
   .register-btn{
      background: linear-gradient(135deg, #2c54a4, #28a745);
      padding: 38px;
      height: 47px;
   }

   .email_not_verified {
      font-size: 18px;
      color: #dc2626; /* red-600 */
      font-weight: 600;
      margin-bottom: 12px;
      text-align: center;
   }

   .verify-btn {
      background: linear-gradient(135deg, #3b82f6, #2563eb); /* blue gradient */
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
      background: linear-gradient(135deg, #1d4ed8, #1e40af); /* darker blue */
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
   }
   .navbar-list{
      padding-left:0px;
   }

   .breadcrumb-item.active {
      color: #fff;
   }

   .breadcrumb-item+.breadcrumb-item::before {
      color: #fff;
   }

   .h2, h2 {
        font-size: 38px;
         line-height: 46px;
         font-size: 700;
    }

      @media only screen and (max-width: 767px) {

   .mob-pad-0{
      padding:0px;
   }
   #signup-form {
      background: white;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 50px;
   }

   .padding-left-50{
   padding-left:15px;
   margin-top: 30px;
   }
   .main-section2 {
   padding: 70px 20px 70px;
   }
   .col-xl-4.col-lg-6.col-md-6 {
   padding: 0px 0px;
   margin-bottom: 30px;
   }
   .jbs-grid-usrs-block {
   padding-top: 14px;
   }
   .jbs-grid-usrs-thumb {
   height: 300px; /* Adjust height for smaller screens */
   }
   .jbs-grid-usrs-thumb img {
   width: 100% !important;
   height: 100% !important;
   object-fit: cover;
   }
   .mob-center{
      text-align:center;

      font-size: 21px;

   }
   }
</style>
@endpush
<section class="inner-section single-banner">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="single-content">
               <h2>Candidate List</h2>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Candidate List</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="main-section2">
   <div class="container">
   @if(Auth::check())
      @if(Auth::user()->hasVerifiedEmail())
      <div class="row">
         <!-- Filter Sidebar -->
         <div class="col-lg-4 col-xl-3 ">
            <form method="GET" action="{{ route('candidates.index') }}" class="form-1">
               <div class="bg-white rounded">
                  <div class="sidebar_header d-flex align-items-center justify-content-between px-2 py-3 br-bottom">
                     <h4 class="fs-bold fs-5 mb-0">Search Filter</h4>
                     <a href="{{ route('candidates.index') }}" class="clear_all ft-medium text-muted">Clear All</a>
                  </div>
                  <hr style="    margin-top: 0px;">
                  <div>
                     <!-- Keyword Search -->
                     <div class="filter-search-box pt-2">
                        <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="Search by keywords..." value="{{ request('keyword') }}">
                        </div>
                     </div>
                     <!-- Candidate Categories -->
                     <div class="product-widget">
                        <h6 class="product-widget-title">
                           <a data-toggle="collapse" href="#jobcategories" role="button" aria-expanded="false" class="toggle-icon">
                           <span>Candidate Categories</span>
                           <i class="fas fa-chevron-down"></i>
                           </a>
                        </h6>
                        <div class="collapse " id="jobcategories">
                           <ul class="no-ul-list filter-list">
                              @foreach($categories as $category)
                              <li>
                                 <input type="checkbox" id="category_{{ $category->id }}" name="category[]" value="{{ $category->id }}" 
                                 {{ is_array(request('category')) && in_array($category->id, request('category')) ? 'checked' : '' }}>
                                 <label for="category_{{ $category->id }}" class="form-check-label">{{ $category->name }}</label>
                              </li>
                              @endforeach
                           </ul>
                        </div>
                     </div>
                     <!-- Candidate Locations -->
                     <div class="product-widget">
                        <h6 class="product-widget-title">
                           <a data-toggle="collapse" href="#joblocation" role="button" aria-expanded="false" class="toggle-icon">
                           <span>Candidate Locations</span>
                           <i class="fas fa-chevron-down"></i>
                           </a>
                        </h6>
                        <div class="collapse " id="joblocation">
                           <ul class="no-ul-list filter-list">
                              @foreach($locations as $location)
                              <li>
                                 <input type="checkbox" id="location_{{ $loop->index }}" name="location[]" value="{{ $location }}" 
                                 {{ is_array(request('location')) && in_array($location, request('location')) ? 'checked' : '' }}>
                                 <label for="location_{{ $loop->index }}" class="form-check-label">{{ $location }}</label>
                              </li>
                              @endforeach
                           </ul>
                        </div>
                     </div>
                     <!-- Skills -->
                     <div class="product-widget">
                        <h6 class="product-widget-title">
                           <a data-toggle="collapse" href="#skills" role="button" aria-expanded="false" class="toggle-icon">
                           <span>Skills</span>
                           <i class="fas fa-chevron-down"></i>
                           </a>
                        </h6>
                        <div class="collapse " id="skills">
                           <ul class="no-ul-list filter-list">
                              @foreach($skills as $skill)
                              <li>
                                 <input type="checkbox" id="skill_{{ $loop->index }}" name="skills[]" value="{{ $skill }}" 
                                 {{ is_array(request('skills')) && in_array($skill, request('skills')) ? 'checked' : '' }}>
                                 <label for="skill_{{ $loop->index }}" class="form-check-label">{{ $skill }}</label>
                              </li>
                              @endforeach
                           </ul>
                        </div>
                     </div>
                     <!-- Experience -->
                     <div class="product-widget">
                        <h6 class="product-widget-title">
                           <a data-toggle="collapse" href="#filterCities" role="button" aria-expanded="false" class="toggle-icon">
                           <span>Experience</span>
                           <i class="fas fa-chevron-down"></i>
                           </a>
                        </h6>
                        <div class="collapse " id="filterCities">
                           <ul class="no-ul-list filter-list">
                              @php
                              $experienceFilters = [0, 1, 2, 3, 4, 5, 10, 15];
                              @endphp
                              @foreach($experienceFilters as $exp)
                              <li>
                                 <input type="radio" id="experience_{{ $exp }}" name="experience" value="{{ $exp }}" 
                                 {{ request('experience') === (string) $exp ? 'checked' : '' }}>
                                 <label for="experience_{{ $exp }}" class="form-check-label">{{ $exp }}+ Years</label>
                              </li>
                              @endforeach
                           </ul>
                        </div>
                     </div>
                     <div class="">
                        <button type="submit" class="product-widget-btn">Search Candidates</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
     
         <!-- Candidate Listings for Authenticated and Verified Users -->
         <div class="col-lg-8 col-xl-9 padding-left-50">
            <div class="row div-row">
               @forelse($candidates as $candidate)
               @php
               $totalExperienceYears = $candidate->experiences->sum(function($exp) {
               $fromDate = \Carbon\Carbon::parse($exp->from_date);
               $toDate = $exp->ongoing ? \Carbon\Carbon::now() : \Carbon\Carbon::parse($exp->to_date);
               if (!$fromDate || !$toDate) {
               return 0;
               }
               $totalMonths = $fromDate->diffInMonths($toDate);
               return $totalMonths / 12;
               });
               @endphp
               <div class="col-xl-4 col-lg-6 col-md-6">
                  <div class="jbs-grid-usrs-block border">
                     <div class="jbs-grid-usrs-thumb">
                        <a href="{{ route('candidate.details', ['id' => Crypt::encrypt($candidate->id)]) }}">
                        <img 
                           src="{{ $candidate->image && $candidate->image
                           ? asset('storage/' . $candidate->image) 
                           : asset('default-profile.png') }}" 
                           class="img-fluid" 
                           alt="{{ $candidate->name }}">
                        </a>
                     </div>
                     <div class="jbs-grid-usrs-caption">
                        <h4>
                           <a href="{{ route('candidate.details', ['id' => Crypt::encrypt($candidate->id)]) }}">{{ $candidate->name }}</a>
                        </h4>
                        <span>{{ $candidate->candidateProfile->profession ?? 'Not specified' }}</span>
                     </div>
                     <div class="jbs-grid-job-edrs">
                        @if($candidate->candidateProfile && $candidate->candidateProfile->skills->isNotEmpty())
                        @foreach($candidate->candidateProfile->skills as $skill)
                        <span>{{ $skill->skill_name }}</span>
                        @endforeach
                        @else
                        <p>No skills added.</p>
                        @endif
                     </div>
                     <div class="jbs-grid-usrs-info">
                        <div class="jbs-info-ico-style bold">
                           <div class="jbs-single-y1 style-2">
                              <span><i class="fas fa-dollar-sign"></i></span>{{ $candidate->candidateProfile->salary ?? 'Not specified' }}/PA
                           </div>
                           <div class="jbs-single-y1 style-3">
                              <span><i class="fas fa-coins"></i></span>{{ floor($totalExperienceYears) }} Years exp.
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @empty
               <p>No candidates found.</p>
               @endforelse
            </div>
            {{ $candidates->links() }} <!-- Pagination -->
         </div>
      </div>
      @else
      @if(session('status') === 'verification-link-sent')
               <p class="text-green-500">A new verification link has been sent to your email address.</p>
      @endif
      <div class="row">
         <div class="col-md-12 text-center">
           <p class="email_not_verified">Your email address hasn’t been verified yet.</p>
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
         <!-- Signup Form for Non-Authenticated or Unverified Users -->
         <!-- <div class="row justify-content-center">
            <div class="col-md-6 mob-pad-0">
            <form action="{{ route('register') }}" method="POST" id="signup-form">
               <h5 class="mb-4 mob-center text-center">Please log in to view candidate listings and details.</h5>
                @csrf
                <div class="row mb-3">
         <div class="col-12 col-md-6 mb-3 mb-md-0">
            <input type="text" class="form-control custom-input" placeholder="Name" name="name" required>
         </div>
         <div class="col-12 col-md-6">
            <input type="text" class="form-control custom-input" placeholder="Username" name="username" required>
         </div>
         </div>
                <div class="mb-3">
                    <input type="email" class="form-control custom-input" placeholder="Business email" name="email" required>
                </div>
                <div class="mb-3 position-relative">
                    <input type="password" class="form-control custom-input" placeholder="Password" id="password" name="password" required>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <div class="mb-3 position-relative">
                  <input type="password" class="form-control custom-input" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required>
                  <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword('password_confirmation')">
                     <i class="fas fa-eye"></i>
                  </span>
               </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="signup_check" name="signup_check" required>
                    <label class="form-check-label small" for="signup_check">
                        By creating this account you accept our <a href="#">Terms to Use</a> and <a href="#">Privacy Policy</a>
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
                <p class="text-center mt-3 small">Already have a Account? <a href="{{ route('user.login') }}">Log in</a></p>
            </form>
            </div>
         </div> -->
         <x-register-form title-text="Please log in to view candidate listings and details." />
         @endif
         {{-- end new code --}}
      </div>
   </div>
   <!-- Signup Modal -->
   <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="{{ route('register') }}" method="POST" id="signup-form">
                  @csrf
                  <div class="row mb-3">
                     <div class="col">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                     </div>
                     <div class="col">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label for="business_email" class="form-label">Business email</label>
                     <input type="email" class="form-control" id="business_email" name="email" required>
                  </div>
                  <div class="mb-3 position-relative">
                     <label for="password" class="form-label">Password</label>
                     <input type="password" class="form-control" id="password" name="password" required>
                     <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword('password')">
                     <i class="fas fa-eye"></i>
                     </span>
                  </div>
                  <div class="mb-3">
                     <label for="password_confirmation" class="form-label">Confirm Password</label>
                     <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                  </div>
                  <div class="mb-3 form-check">
                     <input type="checkbox" class="form-check-input" id="signup_check" name="signup_check" required>
                     <label class="form-check-label" for="signup_check">By creating this account you accept our <a href="{{ route('terms-of-use') }}" target="_blank">Terms to Use and Privacy Policy</a></label>
                  </div>
                  <input type="hidden" name="account_type" value="4">
                  <div class="mb-3">
                     <div id="signup-error" class="text-danger" style="display: none;"></div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100" id="signup-btn">
                  Register Now
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                  </button>
                  <p class="text-center mt-2">Already have a Eversabz? <a href="{{ route('user.login') }}">Log in</a></p>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                       $errorDiv.removeClass('text-danger').addClass('text-success').text(response.message).show();
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
@endpush
@endsection