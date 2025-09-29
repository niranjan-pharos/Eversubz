@extends('admin.template.master')

@section('content')

<div class="search-lists">
  <div class="tab-content">
    <div class="row">
      <div class="col-md-12"> 
        <div class="card">
          <div class="card-body">
            <h3 class="text-center">User Details - {{ $user->name }}</h3>
            <hr>
            <div class="row">
              <div class="col-md-4">
                <p class="user-title">Profile Image</p>
                <div class="profile-image1">
                  <a href="{{ asset('storage/' . $user->image) }}">
                    @if ($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                      class="rounded-circle profile-image">
                    @else
                    <!-- Default static image -->
                    <img src="{{ asset('assets/images/no-image.jpg') }}" alt="Default Image"
                      class="rounded-circle profile-image">
                    @endif
                  </a>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <p class="user-title">Name:</p>
                    <p class="user-title1">{{ $user->name }}</p>
                  </div>
                  <div class="col-md-6">
                    <p class="user-title">User Id:</p>
                    <p class="user-title1">{{ $user->uid }}</p>
                  </div>
                  <div class="col-md-6">
                    <p class="user-title">Username:</p>
                    <p class="user-title1">{{ $user->username }}</p>
                  </div>
                  <div class="col-md-6">
                    <p class="user-title">Email:</p>
                    <p class="user-title1">{{ $user->email }}</p>
                  </div>
                  <div class="col-md-6">
                    <p class="user-title">Phone:</p>
                    <p class="user-title1">{{ $user->phone }}</p>
                  </div>
                </div>
              </div>



            </div>
            <hr>

            <div class="row">
              <div class="col-md-12">
                <h4 class="text-center">Company Details</h4>
              </div>
              <div class="col-md-6">
                <p class="user-title">Campany Name:</p>
                <p class="user-title1">{{ $userDetail?->company }}</p>
              </div>
              <div class="col-md-6">
                <p class="user-title">Campany Website:</p>
                <p class="user-title1">{{ $userDetail?->website }}</p>
              </div>

            </div>
            <hr>

            <div class="row">
              <div class="col-md-12">
                <h4 class="text-center">Billing Address</h4>
              </div>
              <div class="col-md-4">
                <p class="user-title">Address:</p>
                <p class="user-title1">{{ $userDetail?->billing_address }}</p>
              </div>
              <div class="col-md-4">
                <p class="user-title">City:</p>
                <p class="user-title1">{{ $userDetail?->billing_city }}</p>
              </div>
              <div class="col-md-4">
                <p class="user-title">State:</p>
                <p class="user-title1">{{ $userDetail?->billing_state }}</p>
              </div>
              <div class="col-md-4">
                <p class="user-title">Country:</p>
                <p class="user-title1">{{ $userDetail?->billing_country }}</p>
              </div>
              <div class="col-md-4">
                <p class="user-title">Post Code:</p>
                <p class="user-title1">{{ $userDetail?->billing_postcode }}</p>
              </div>


            </div>
            <hr>

            <div class="row">
              <div class="col-md-12">
                <h4 class="text-center">Shippng Address</h4>
              </div>
              <div class="col-md-4">
                <p class="user-title">Address:</p>
                <p class="user-title1">{{ $userDetail?->shipping_address }}</p>
              </div>
              <div class="col-md-4">
                <p class="user-title">City:</p>
                <p class="user-title1">{{ $userDetail?->shipping_city }}</p>
              </div>
              <div class="col-md-4">
                <p class="user-title">State:</p>
                <p class="user-title1">{{ $userDetail?->shipping_state }}</p>
              </div>
              <div class="col-md-4">
                <p class="user-title">Country:</p>
                <p class="user-title1">{{ $userDetail?->shipping_country }}</p>
              </div>
              <div class="col-md-4">
                <p class="user-title">Post Code:</p>
                <p class="user-title1">{{ $userDetail?->shipping_postcode }}</p>
              </div>


            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
  h4{font-size:22px;margin-bottom:15px;}
  .profile-image {
    width: 175px;
  }

  .profile-image1 {
    width: 175px;
    border-radius: 50%;
    padding: 3px;
    border: 3px solid #0044bb;
  }
 /* Optional: Add box shadow to card for depth */
 .card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .user-title {
    font-size: 18px;
    /* text-decoration: underline; */
    font-weight: 800;
  }

 
</style>

@endsection