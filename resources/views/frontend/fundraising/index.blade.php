@extends('frontend.template.master')
@section('title',  "my events")

 
@section('content')
@include('frontend.template.usermenu')
<style>
.btn{padding:.375rem .75rem}.product-card{margin:0}.product-btn a,.product-btn button{margin-left:6px;padding-left:6px}body{background:#fff}.flat-badge{position:absolute;top:0;right:0}.breadcrumb-item+.breadcrumb-item::before{content:none}body{background:#F9FAFB}.product-widget,.product-card{background:#fff}.product-category .breadcrumb-item::before{content:none}.product-category{height:auto;margin-bottom:0;padding:10px 0 8px;border-bottom:1px solid var(--border);flex-wrap:nowrap;column-gap:10px;justify-content:space-between}.product-price{font-size:14px!important}.filter-button1{display:flex;column-gap:5px}.product-content{padding:.875rem}.product-img img{width:100%;height:200px;object-fit:contain}.product-title{height:auto;font-size:.875rem}.product-card-column{padding:0 5px}.product-card{margin:0 0 10px}@media only screen and (max-width:737px){.product-img img{width:100%;height:auto}.product-card{width:auto}.myads-part{padding:50px 0 80px}}
</style>
<section class="inner-section category-part myads-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-filter">
                    <div class="filter-show">
                        <label class="filter-label">Show :</label>
                        <select class="custom-select filter-select" id="resultsPerPage">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="filter-short">
                        <label class="filter-label">Short by :</label>
                        <select class="custom-select filter-select" id="postFilter">
                            <option selected="" data-filter="all">All Ads</option>
                            <option value="3" data-filter="Booking">Booking Ads</option>
                            <option value="2" data-filter="Rent">Rental Ads</option>
                            <option value="1" data-filter="Sale">Sale Ads</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="row">
            @foreach($fundraisings as $fundraising)
            @php
            $viewUrl =  route('fundaraising.show', $fundraising->slug);
            @endphp
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 product-card-column">
                <div class="product-card">
                    <div class="product-media">
                        <div class="product-img recommend-product-img">
                            <img loading="eager" src="{{ asset('storage/' . $fundraising->main_image) }}" class="img-fluid" alt="{{$fundraising->title}}">
                        </div>
                    </div>
                    <div class="product-content">
                        <ol class="breadcrumb product-category">
                            @if ($fundraising->from_date_time)
                            <li class="breadcrumb-item">
                                @if (\Carbon\Carbon::parse($fundraising->from_date_time)->format('Y-m-d') ==
                                \Carbon\Carbon::parse($fundraising->to_date_time)->format('Y-m-d'))
                                {{ \Carbon\Carbon::parse($fundraising->from_date_time)->format('D jS M, h:i a') }}
                                - {{ \Carbon\Carbon::parse($fundraising->to_date_time)->format('h:i a') }}
                                @else
                                {{ \Carbon\Carbon::parse($fundraising->from_date_time)->format('D jS M, h:i a') }}
                                - {{ \Carbon\Carbon::parse($fundraising->to_date_time)->format('D jS M, h:i a') }}
                                @endif
                            </li>
                            @else
                            N/A
                            @endif
                            <li class="breadcrumb-item product-price">
                                
                                ${{ $fundraising->amount }}
                            </li>
                        </ol>
                        <h5 class="product-title"><a href="{{ route('fundaraising.show', $fundraising->slug) }}">
                                {{ strlen($fundraising->title) > 30 ? substr($fundraising->title, 0, 30) . '...' : $fundraising->title }}
                            </a></h5>
                        <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>{{ $fundraising->city." ," }}
                                {{ $fundraising->state }}</span>
                        </div>
                        <div class="product-info">
                            <div class="product-btn d-flex">
                            <a class="events-links" href="{{ route('fundraising.edit', $fundraising->slug) }}"><i class="fas fa-edit"></i></a>
                                
                                <a class="events-links delete-event" href="javascript:void(0);"
                                    data-url="{{ route('fundraising.destroy', ['slug' => $fundraising->slug]) }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <button type="button" title="Details" aria-label="Details" class="fa fa-info-circle detailsButton"
                                onclick="window.location.href='{{ $viewUrl }}'"></button>
                                <div class="ad-details-action">
                                    @if (Auth::id() !== $fundraising->user_id)
                                    <button type="button" title="Details" aria-label="Details" class="fa fa-info-circle detailsButton"
                                    onclick="window.location.href='{{ $viewUrl }}'"></button>
                                    @endif
                                </div>
                                <span class="flat-badge {{ $fundraising->status == 1 ? 'bg-success' : 'bg-danger' }} ">
                                    {{ $fundraising->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
</section>  
<script>
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.delete-event', function(e) {
        e.preventDefault();
        var url = $(this).data('url');

        if (confirm('Are you sure you want to delete this event?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.success);
                        $(e.target).closest('.product-card-column').remove();
                    } else {
                        toastr.error(response.error);
                    }
                },
                error: function(response) {
                    toastr.error('An error occurred while deleting the event.');
                }
            });
        }
    });
});
</script>


@endsection