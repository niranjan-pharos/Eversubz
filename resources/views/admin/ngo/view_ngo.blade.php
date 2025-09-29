@extends('admin.template.master')

@section('content')

<div class="search-lists">
    <div class="tab-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Ngo Details - {{ $ngoInfo?->ngo_name }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <p class="user-title">Logo</p>
                                <div class="profile-image1">
                                    <img src="{{ asset('storage/' . $ngoInfo?->logo_path) }}"
                                        alt="{{ $ngoInfo?->ngo_name }}" class="rounded-circle profile-image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="user-title">NGO Name:</p>
                                        <p class="user-title1">{{ $ngoInfo?->ngo_name }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <p class="user-title">Establishment Year:</p>
                                        <p class="user-title1">{{ $ngoInfo?->establishment }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">ABN:</p>
                                        <p class="user-title1">{{ $ngoInfo?->abn }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">ACNC:</p>
                                        <p class="user-title1">{{ $ngoInfo?->acnc }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">GST:</p>
                                        <p class="user-title1">{{ $ngoInfo?->gst }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">Email:</p>
                                        <p class="user-title1">{{ $ngoInfo?->contact_email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">Website:</p>
                                        <p class="user-title1">{{ $ngoInfo?->website_url }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="user-title">Phone:</p>
                                        <p class="user-title1">{{ $ngoInfo?->contact_phone }}</p>
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
                                <p class="user-title1">{{ $ngoInfo?->ngo_address }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">City:</p>
                                <p class="user-title1">{{ $ngoInfo?->ngo_city }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">State:</p>
                                <p class="user-title1">{{ $ngoInfo?->ngo_state }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">Country:</p>
                                <p class="user-title1">{{ $ngoInfo?->ngo_country }}</p>
                            </div>
                            
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Social Media</h4>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">Facebook:</p>
                                <p class="user-title1">{{ $ngoInfo?->facebook_url }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">Twitter:</p>
                                <p class="user-title1">{{ $ngoInfo?->twitter_url }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">Instagram:</p>
                                <p class="user-title1">{{ $ngoInfo?->instagram_url }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="user-title">Linkedin:</p>
                                <p class="user-title1">{{ $ngoInfo?->linkedin_url }}</p>
                            </div>
                             
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Description</h4>
                            </div>
                            <div class="col-md-12">
                                <p class="user-title">Description:</p>
                                <p class="user-title1">{!! $ngoInfo?->ngo_description !!}</p>
                            </div>
                            
                        </div>
                        <hr>

                        
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