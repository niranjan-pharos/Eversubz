@extends('frontend.template.master')
@section('title', "my events")


@section('content')
@include('frontend.template.usermenu')
<style>
    .btn {
        padding: .375rem .75rem
    }

    .product-card {
        margin: 0
    }

    .product-btn a,
    .product-btn button {
        margin-left: 6px;
        padding-left: 6px
    }

    .events-links {
        text-decoration: underline;
        font-size: 14px
    }

    .events-links:hover {
        font-size: 15px
    }

    body {
        background: #fff
    }

    .flat-badge {
        position: absolute;
        top: 0;
        right: 0
    }

    body {
        background: #F9FAFB
    }

    .product-widget,
    .product-card {
        background: #fff
    }

    .product-category .breadcrumb-item::before {
        content: none
    }

    .product-category {
        height: auto;
        margin-bottom: 0;
        padding: 10px 0 8px;
        border-bottom: 1px solid var(--border);
        flex-wrap: nowrap;
        column-gap: 10px;
        justify-content: space-between
    }

    .product-price {
        font-size: 14px !important
    }

    .filter-button1 {
        display: flex;
        column-gap: 5px
    }

    .product-content {
        padding: .875rem
    }

    .product-img img {
        width: 100%;
        height: 200px;
        object-fit: contain
    }

    .product-title {
        height: auto;
        font-size: .875rem
    }

    .product-card-column {
        padding: 0 5px
    }

    .product-card {
        margin: 0 0 10px
    }

    @media only screen and (max-width:737px) {
        .product-img img {
            width: 100%;
            height: auto
        }

        .product-card {
            width: auto
        }

        .myads-part {
            padding: 50px 0 80px
        }
    }
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
            @foreach($events as $event)
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-6 product-card-column">
                <div class="product-card">
                    <div class="product-media">
                        <div class="product-img recommend-product-img">
                            <img loading="eager"
                                src="{{ asset('storage/' . App\Helpers\ImageHelper::getThumbnailPath($event->main_image)) }}"
                                alt="{{ $event->title }}">
                        </div>
                    </div>
                    <div class="product-content">
                        <ol class="breadcrumb product-category">
                            @if ($event->from_date_time)
                            <li class="breadcrumb-item">
                                @if (\Carbon\Carbon::parse($event->from_date_time)->format('Y-m-d') ==
                                \Carbon\Carbon::parse($event->to_date_time)->format('Y-m-d'))
                                {{ \Carbon\Carbon::parse($event->from_date_time)->format('D jS M, h:i a') }}
                                - {{ \Carbon\Carbon::parse($event->to_date_time)->format('h:i a') }}
                                @else
                                {{ \Carbon\Carbon::parse($event->from_date_time)->format('D jS M, h:i a') }}
                                - {{ \Carbon\Carbon::parse($event->to_date_time)->format('D jS M, h:i a') }}
                                @endif
                            </li>
                            @else
                            N/A
                            @endif
                        </ol>
                        <h5 class="product-title"><a href="{{ route('event.show', ['slug' => $event->slug]) }}">
                                {{ strlen($event->title) > 30 ? substr($event->title, 0, 30) . '...' : $event->title }}
                            </a></h5>
                        <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>{{ $event->city." ," }}
                                {{ $event->state }}</span>
                        </div>
                        <div class="product-info">
                            <div class="product-btn">
                                <div class="ad-details-action">
                                    @if (Auth::id() !== $event->user_id)
                                    <button type="button" title="Wishlist" aria-label="Add to wishlist"
                                        class="fa-heart wishlistButton far" data-ad-id="{{ $event->id }}"></button>
                                    @endif
                                </div>
                                <a class="events-links"
                                    href="{{ route('event.enquiries.show', ['event_slug' => $event->slug]) }}">Enquiries</a>
                                <a class="events-links" href="{{ route('event.tickets', Crypt::encrypt($event->id)) }}">Sold Tickets</a>
                                <a class="events-links" href="{{ route('EventsEdit', $event->slug) }}"><i
                                        class="fas fa-edit"></i></a>
                                <a class="events-links delete-event" href="javascript:void(0);"
                                    data-url="{{ route('event.destroy', ['slug' => $event->slug]) }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <span class="flat-badge {{ $event->status == 1 ? 'bg-success' : 'bg-danger' }} ">
                                    {{ $event->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
$(document).ready(function() {
    $('#category_id').select2({
        placeholder: '--- Search Category ---',
        allowClear: !0,
        ajax: {
            url: '{{ route("api.event-categories") }}',
            type: "POST",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term
                }
            },
            processResults: function(data) {
                return {
                    results: $.map(data.categories, function(item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                }
            },
            cache: !0
        }
    })
});
var base_url = "{{ url('/') }}";

function viewFunc(slug) {
    window.location.href = base_url + '/events/' + slug
}

function editFunc(slug) {
    window.location.href = base_url + '/events/' + slug + '/edit'
}
</script>
@endsection