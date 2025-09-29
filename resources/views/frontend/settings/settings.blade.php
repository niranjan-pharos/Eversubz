@extends('frontend.template.master')

@section('content')
@include('frontend.template.usermenu')


<style>
 .dash-avatar a img{width:175px;border-radius:50%;border:3px solid #fff;height:175px}
</style>
<section class="setting-part">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="account-card alert fade show">
               <div class="account-title">
                  <h3>Edit Profile</h3>
               </div>

               <form class="setting-form" action="{{ route('settings.update') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('patch')
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="row">
                           <div class="col-lg-3">
                              <div class="form-group dash-avatar">
                                 <a href="{{ asset('storage/' . $user->image) }}">
                                    @if ($user->image) 
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                                       class="rounded-circle profile-image">
                                    @else
                                    <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Default Image"
                                       class="rounded-circle profile-image">
                                    @endif
                                 </a>
                              </div> 
                           </div>
                           <div class="col-lg-3">
                              <div class="form-group"><label class="form-label">Profile Image</label><input type="file"
                                    class="form-control" name="profile_image"></div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Name</label><input type="text"
                              class="form-control" name="name" value="{{ $user->name }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Username</label><input type="text"
                              class="form-control" name="username" value="{{ $user->username }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Phone</label><input type="number"
                              class="form-control" name="phone" value="{{ $user->phone }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Email</label><input type="email"
                              class="form-control" name="email" readonly value="{{ $user->email }}"></div>
                     </div>


                     {{-- <div class="col-lg-12">
                        <h4>Company Details </h4>
                        <br>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Company</label><input type="text"
                              class="form-control" placeholder="Classicads Advertising LID." name="company"
                              value="{{ $userDetail->company ?? '' }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Website</label><input type="text"
                              class="form-control" placeholder="https://mironmahmud.com/" name="website"
                              value="{{ $userDetail->website ?? '' }}"></div>
                     </div> --}}



                     <div>
                        <h4>Billing Address</h4>
                        <br>

                     </div>
                     <div class="col-lg-12">
                        <div class="form-group"><label class="form-label">Address</label><input type="text"
                              class="form-control" placeholder="1420, West Jalkuri, Narayanganj, Bangladesh"
                              name="billing_address" value="{{ $userDetail->billing_address ?? '' }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">City</label><input type="text"
                              class="form-control" placeholder="Narayanganj" name="billing_city"
                              value="{{ $userDetail->billing_city ?? '' }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">State</label><input type="text"
                              class="form-control" placeholder="West Jalkuri" name="billing_state"
                              value="{{ $userDetail->billing_state ?? '' }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Post Code</label><input type="text"
                              class="form-control" placeholder="1420" name="billing_postcode"
                              value="{{ $userDetail->billing_postcode ?? '' }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Country</label><input type="text"
                              class="form-control" placeholder="Bangladesh" name="billing_country"
                              value="{{ $userDetail->billing_country ?? '' }}"></div>
                     </div>

                     <div>
                        <h4>Shipping Address</h4>
                        <br>

                     </div>
                     <br>
                     <div class="col-lg-12">
                        <div class="form-group"><label class="form-label">Address</label><input type="text"
                              class="form-control" placeholder="1420, West Jalkuri, Narayanganj, Bangladesh"
                              name="shipping_address" value="{{ $userDetail->shipping_address ?? '' }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">City</label><input type="text"
                              class="form-control" placeholder="Narayanganj" name="shipping_city"
                              value="{{ $userDetail->shipping_city ?? '' }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">State</label><input type="text"
                              class="form-control" placeholder="West Jalkuri" name="shipping_state"
                              value="{{ $userDetail->shipping_state ?? '' }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Post Code</label><input type="text"
                              class="form-control" placeholder="1420" name="shipping_postcode"
                              value="{{ $userDetail->shipping_postcode ?? '' }}"></div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group"><label class="form-label">Country</label><input type="text"
                              class="form-control" placeholder="Bangladesh" name="shipping_country"
                              value="{{ $userDetail->shipping_country ?? '' }}"></div>
                     </div>



                     <div class="col-lg-12"><button class="btn btn-inline"><i class="fas fa-user-check"></i><span>update
                              profile</span></button></div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection