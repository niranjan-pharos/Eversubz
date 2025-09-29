@extends('admin.template.master')

@section('content')

{{-- {{ dd($fundraising) }} --}}

<div class="search-lists">
    <div class="tab-content">
    

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <div class="div-title col-md-12">
                                <p><strong>Title:</strong></p>

                                <h4> {{ $fundraising->title }}</span> </h4>
                            </div>
                           
                            <div class="div-title col-md-4">
                                <p><strong>For:</strong></p>

                                <p> {{ $fundraising->for }}</span> </p>
                            </div>
                            <div class="div-title col-md-4">
                                <p><strong>Fundarasing Slug:</strong></p>

                                <p> {{ $fundraising->slug }}</span> </p>
                            </div>
                            <div class="div-title col-md-4">
                                <p><strong>Created By:</strong></p>

                                <p> {{ $fundraising->user->name }}</span> </p>
                            </div>
                            <div class="div-title col-md-4">
                                <p><strong>fundarasing Category:</strong></p>

                                <p> {{ $fundraising->category->name }}</span> </p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Amount:</strong></p>
                                <p> $ {{ isset($fundraising->amount) && $fundraising->amount != 0 ? $fundraising->amount : 'Free' }}</p>
                            </div>
                            @php
                                $from_date_time = new DateTime($fundraising->from_date_time);
                                $to_date_time = new DateTime($fundraising->to_date_time);

                                $from_formattedDate = $from_date_time->format('D jS M Y, g:i a');
                                $to_formattedDate = $to_date_time->format('D jS M Y, g:i a T');

                                $dateTimeDisplay = $from_formattedDate . ' - ' . $to_formattedDate;
                                @endphp
                            <div class="div-title col-md-5">
                                <p><strong>Duration:</strong></p>
                                <p>{{ $dateTimeDisplay }}</p>
                            </div>

                            
                            <div class="div-title col-md-3">
                                <p><strong>Location:</strong></p>
                                <p> <span class="ad-details-span">{{ $fundraising->location }}</span></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>City:</strong></p>
                                <p> <span class="ad-details-span">{{ $fundraising->city }}</span></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>State:</strong></p>
                                <p> <span class="ad-details-span">{{ $fundraising->state }}</span></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Country:</strong></p>
                                <p> <span class="ad-details-span">{{ $fundraising->country }}</span></p>
                            </div>

                            <div class="div-title col-md-3">
                                <p><strong>Facebook Link:</strong></p>
                                <p> <a href="{{ $fundraising->facebook_link }}" target="_blank"><span
                                            class="ad-details-span">{{ $fundraising->facebook_link }}</span></a></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>LinkedIn Link:</strong></p>
                                <p> <a href="{{ $fundraising->linkedin_link }}" target="_blank"><span
                                            class="ad-details-span">{{ $fundraising->linkedin_link }}</span></a></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>X Link:</strong></p>
                                <p> <a href="{{ $fundraising->x_link }}" target="_blank"><span class="ad-details-span">{{
                                            $fundraising->x_link }}</span></a></p>
                            </div>

                            <div class="div-title col-md-3">
                                <p><strong>Event URL:</strong></p>
                                <p> <a href="{{ $fundraising->copy_fundraising_url }}" target="_blank"><span
                                            class="ad-details-span">{{ $fundraising->copy_fundraising_url }}</span></a></p>
                            </div>

                            <div class="div-title col-md-3">
                                <p><strong>Video Link:</strong></p>
                                <p> <a href="{{ $fundraising->copy_fundraising_url }}" target="_blank"><span
                                            class="ad-details-span">{{ $fundraising->video_link }}</span></a></p>
                            </div>

                            

                            
                            <div class="div-title col-md-12">
                                <p><strong>Description: </strong> </p>
                                <p><span class="ad-details-span">{!! $fundraising->fundraising_description !!}</span></p>
                            </div>




                            <div class="div-title col-md-12">
                                <div class="row ad-images">
                                    <p><strong>Main Images: </strong></p>
                                    <div class="col-md-3">
                                    @if($fundraising->main_image)
                                    <img src="{{ asset('storage/' . $fundraising->main_image) }}" alt="{{$fundraising->title}}"
                                        style="max-width: 100px;">
                                    @endif
                                    </div>
                                </div>
                            </div>

                            <div class="div-title col-md-12">
                                <div class="row ad-images">
                                    <p><strong>Additional Images: </strong></p>
                                    @foreach($fundraising->fundraisingImages as $image)
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Event Image"
                                            style="max-width: 100px;">
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        <a href="{{ route('adminFundraising') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
<style>
    .change-post-status-span {
        float: right;
        font-size: 23px;
        margin: -50px 0px 0px;
    }

    .page-header12 {
        display: none;
    }

    .ad-details-titlespan {
        font-size: 18px;
    }

    .review-item {
        padding: 0px;
        background: none;
        border: none;
        border-radius: 0px;
        margin-bottom: 0px;
    }

    .review-item .review-user {
        background: var(--chalk);
        border: 1px solid var(--border);
        border-radius: 8px;
        margin-bottom: 25px;
        height: 100%;
        padding: 10px;
        margin: 10px;
    }

    .review-list {
        margin-bottom: 50px;
        column-gap: 10px;
        /* margin: 0px auto; */
        /* justify-content: center; */
    }

    .div-title {
        margin-bottom: 25px;
    }

    .div-title p strong {
        font-size: 18px;
    }

    /* Add your CSS styles here */
    h4 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #336699;
        /* Highlighted change: Added color */
    }

    .ad-detail p {
        display: flex;
        justify-content: space-between;
        padding: 15px 0px;
    }

    .ad-detail span {
        padding-left: 10px;
    }

    /* Optional: Add box shadow to card for depth */
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Tags list styling */
    .ad-tags-list {
        justify-content: space-between;
        display: flex;
        margin-bottom: 0;
    }

    .ad-details {}

 

    .div-title p .p1 {
        margin-right: 10px;
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    /* Animation for images */
    .ad-image {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 10px auto;
        transition: transform 0.3s ease-in-out;
        /* Add image hover animation */
    }

    /* Add zoom effect on image hover */
    .ad-image:hover {
        transform: scale(1.1);
    }
</style>

@endsection