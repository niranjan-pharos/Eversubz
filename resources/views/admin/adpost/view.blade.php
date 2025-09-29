@extends('admin.template.master')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col"> 
            <ul class="breadcrumb">
                @foreach($breadcrumbs as $breadcrumb)
                    @if($breadcrumb['url'])
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['label'] }}</li>
                    @endif
                @endforeach
            
            </ul>

        </div>
        <!-- <div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Holiday</a>
							</div> -->
    </div>
</div>
{{-- {{ dd($adPost) }} --}}
<div class="search-lists">
    <div class="tab-content">
        
 

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Ads Details</h4>
                                <span class="change-post-status-span">
                                    <div class="form-check form-switch">Change Post Status
                                        <input class="form-check-input change-status" data-id="{{ $adPost->id }}"
                                            type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $adPost->status
                                        == 1 ? 'checked' : '' }}>
                                    </div>
                                </span>

                            </div>
                            <div class="div-title col-md-12">
                                <p><strong>Title:</strong> <span class="ad-details-span ad-details-titlespan">{{
                                        $adPost['title'] }}</span>
                                </p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Category:</strong></p>
                                <p>{{ $adPost->category->name }}</p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Sub Category:</strong></p>
                                <p>{{ $adPost->subcategory->name }}</p>
                            </div>

                            <div class="div-title col-md-6 ">
                                <p><strong>Tags:</strong></p>
                                @if ($adPost->tags->count() > 0)
                                <div
                                    class="col-md-12 div-title col-md-6 ad-details ad-tags category-li ad-details ad-tags-list">
                                    <div class="row col-md-12">
                                        @foreach ($adPost->tags as $tag)
                                        <div class="col-md-2 p1">{{ $tag->tag_name }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Location:</strong></p>
                                <p>{{ $adPost->location }}</p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Price:</strong></p>
                                <p> <span class="ad-details-span">{{ $adPost['price'] }}</span></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Product Condition:</strong></p>
                                <p> <span class="ad-details-span">{{ $adPost['product_condition']
                                        }}</span></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Price Condition:</strong></p>
                                <p> <span class="ad-details-span">{{ $adPost['price_condition']
                                        }}</span></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Ads Category:</strong></p>
                                <p> <span class="ad-details-span">{{ $adPost['ad_category'] }}</span></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>ABN:</strong></p>
                                <p> <span class="ad-details-span">{{ $adPost->abn }}</span></p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Video URL:</strong></p>
                                <p> <a href="{{ $adPost->video_url }}" target="_blank"><span class="ad-details-span">{{
                                            $adPost->video_url }}</span></a></p>
                            </div>
                            <div class="div-title col-md-12">
                                <p><strong>Description: </strong> </p>
                                <p><span class="ad-details-span">{!!
                                        $adPost['description'] !!}</span></p>
                            </div>
                            <div class="div-title col-md-12">
                                @if ($adPost->images->count() > 0)
                                <div class="row ad-images">
                                    <p><strong>Images: </strong></p>
                                    @foreach ($adPost->images as $image)
                                    <div class="col-lg-2">
                                        <a href="{{ asset('public/storage/'. $image->url) }}" target="_blank"
                                            class="ad-image-link">
                                            <img src="{{ asset('public/storage/'. $image->url) }}"
                                                alt="{{ $adPost->title }}" class="ml-2 ad-image">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">User Details</h4>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Name:</strong></p>
                                <p>{{ $adPost->user->name }}</p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Username:</strong></p>
                                <p>{{ $adPost->user->username }}</p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Email:</strong></p>
                                <p>{{ $adPost->user->email }}</p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Phone Number:</strong></p>
                                <p>{{ $adPost->user->phone }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Ad Author Details</h4>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Author Name:</strong></p>
                                <p>{{ $adPost->author_name }}</p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Author Address:</strong></p>
                                <p>{{ $adPost->author_address }}</p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Author Email:</strong></p>
                                <p>{{ $adPost->author_email }}</p>
                            </div>
                            <div class="div-title col-md-3">
                                <p><strong>Author Phone Number:</strong></p>
                                <p>{{ $adPost->author_phone }}</p>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Reports</h4>
                            </div>
                            <div class="ad-details-review">
                                <ul class="review-list row">
                                    @foreach($reports as $report)
                                    <li class="review-item col-md-3">
                                        <div class="review-user">
                                            <div class="review-head">
                                                <div class="review-profile">

                                                    <div class="review-meta">
                                                        <h6><strong>Reason For Reporting: </strong>{{ $report->reason }}
                                                            -
                                                            <br> <span>{{ $report->created_at->format('F d, Y')
                                                                }}</span>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                            <p class=""><strong>Additional Details:</strong>- {{ $report->details }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>





                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center">Reviews</h4>
                            </div>
                            <div class="ad-details-review">
                                <ul class="review-list row">
                                    @foreach($reviews as $review)
                                    <li class="review-item col-md-3">
                                        <div class="review-user">
                                            <div class="review-head">
                                                <div class="review-profile">

                                                    <div class="review-meta">
                                                        <h6>{{ $review?->name }} - <span>({{
                                                                $review?->email }})</span>
                                                            <br><span>{{ $review?->created_at->format('F d, Y')
                                                                }}</span>
                                                            <div class="form-check form-switch"> <span>Review
                                                                    Status</span>

                                                                <input class="form-check-input change-status-checkbox"
                                                                    data-review-id="{{ $review->id }}" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckChecked" {{
                                                                    $review->status == 1 ? 'checked' : '' }}>

                                                            </div>
                                                        </h6>
                                                        <ul>
                                                            @for($i = 1; $i <= $review?->rating; $i++)
                                                                <li><i class="fas fa-star active"></i></li>
                                                                @endfor
                                                                <li>
                                                                    <h5>- for {{ $review?->category }}</h5>
                                                                </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="review-desc">{{ $review?->description }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>





                            </div>
                        </div>
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
    .review-item .review-user{background: var(--chalk);
    border: 1px solid var(--border);
    border-radius: 8px;
    margin-bottom: 25px;
    height:100%;
    padding: 10px;
    margin: 10px;}

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

    h3 {
        text-align: center;
    }

    .ad-tags-list .p1 {
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

<script>
    $(document).ready(function () {
        // Listen for change event on checkbox
        $(document).on('change', '.change-status-checkbox', function () {
            var reviewId = $(this).data('review-id');
            var status = $(this).is(':checked') ? 1 : 0; // If checked, status is 1, else 0

            $.ajax({
                url: "{{ route('review.change_status') }}",
                method: 'PUT', // Use PUT method for updating records
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: reviewId,
                    status: status
                },
                success: function (response) {
                    // Handle success response
                    console.log(response);
                    toastr.success(response.message)
                    // Update UI if needed
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error(error);
                    toastr.success(response.message)
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        // change status 
        $('body').on('click', '.change-status', function () {
            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('post.change-status') }}",
                method: 'PUT',
                data: {
                    "_token": "{{ csrf_token() }}",
                    status: isChecked,
                    id: id
                },
                success: function (response) {
                    console.log(response);
                    toastr.success(response.message);
                }
            });
        });
    });
</script>

@endsection