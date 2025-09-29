@extends('frontend.template.master')
@section('title', "Buy Events Listing")


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

    
    .btn-primary {
        font-size: 0.9rem; 
        padding: 6px 16px; 
        border-radius: 25px;
        font-weight: normal;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: scale(1.03);
    }

    .sold-ticket{margin-bottom: 20px;}

.sold-ticket .card {height: 100%;
    transition: box-shadow 0.3s ease;border-bottom: 7px solid #C9E3FF;
    border-radius: 10px;
    }

    .sold-ticket  .card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
    }
    .sold-ticket .card-body{padding: 0px;}
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
        
        <div class="container py-3">
            <h3 class=" mb-2" style="font-family: 'Arial', sans-serif; color: #333;">Your Purchased Tickets</h3>
            
            <div class="row">
                @forelse($orders as $order)
                    <div class="col-md-6 mb-4 sold-ticket">
                        <div class="card shaow-lg  p-3" style="background-color: #f9f9f9;">
                            <div class="card-body d-flex align-items-center">
                                
                                <img src="{{ asset('storage/'.$order->event->main_image) ?? 'default_event_icon.png' }}" alt="Event Icon" class="rounded-circle mr-1" style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #007bff;" />
                                
                                <div class="ml-2 flex-grow-1">
                                    <h5 class="card-title mb-2" style="font-size: 17px; font-weight: bold; color: #007bff;">Order #{{ $order->order_event_unique_id }}</h5>
                                    <p class="mb-1" style="font-size: 1rem; color: #333;">Event: <strong>{{ $order->event->title ?? 'N/A' }}</strong></p>
                                    <p class="mb-0" style="font-size: 0.8rem; color: #444;">Total: <strong>{{ config('constants.CURRENCY_SYMBOL') . number_format($order->total_amount, 2) }}</strong></p>
                                </div>
        
                                <div>
                                    <a href="{{ route('event.success', ['encryptedOrderId' => Crypt::encryptString($order->id)]) }}" class="btn btn-primary btn-sm px-3 py-2" style="font-size: 13px; border-radius: 25px; text-transform: uppercase;">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center" style="font-size: 1.2rem; color: #333;">You have not purchased any tickets yet.</div>
                @endforelse
            </div>
        
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
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