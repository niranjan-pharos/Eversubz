@extends('admin.template.master')

@section('content')

<div class="search-lists">
    <div class="tab-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Business Details - {{ $businessInfo->business_name }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <p class="user-title">Logo</p>
                                <div class="profile-image1">
                                    <img src="{{ asset('storage/' . $businessInfo->logo_path) }}"
                                        alt="{{ $businessInfo->business_name }}" class="rounded-circle profile-image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="user-title">Business Name:</p>
                                        <p class="user-title1">{{ $businessInfo->business_name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">Business Category:</p>
                                        <p class="user-title1">{{ $businessCategory->name }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="user-title">Establishment Year:</p>
                                        <p class="user-title1">{{ $businessInfo->establish_year }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">ABN:</p>
                                        <p class="user-title1">{{ $businessInfo->abn }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">Email:</p>
                                        <p class="user-title1">{{ $businessInfo->contact_email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">Phone:</p>
                                        <p class="user-title1">{{ $businessInfo->contact_phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Business Address</h4>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">Address:</p>
                                <p class="user-title1">{{ $businessInfo->business_address }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">City:</p>
                                <p class="user-title1">{{ $businessInfo->business_city }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">State:</p>
                                <p class="user-title1">{{ $businessInfo->business_state }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">Country:</p>
                                <p class="user-title1">{{ $businessInfo->business_country }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">Postal Code:</p>
                                <p class="user-title1">{{ $businessInfo->business_postcode }}</p>
                            </div>
                        </div>
                        <hr>

                        <!-- Include other business information here -->
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
h4 {
    font-size: 22px;
    margin-bottom: 15px;
}

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