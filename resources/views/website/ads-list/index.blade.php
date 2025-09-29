@extends('frontend.template.master')
@section('title', 'Post and Discover Ads Effortlessly | Eversabz Ad Listings')
@section('description', 'Discover a wide range of ads on Eversabz. Browse, post, and find the best deals in various categories. Easy, fast, and user-friendly platform for everyone!')
@section('content')
@php
    $currentType = request('type', 'all');
@endphp


<style>
    .no-result {
        color: #000;
        font-size: 16px;
        text-align: center;
        width: 320px;
        padding: 13px;
        border: 1px solid #2d64af;
        border-radius: 7px;
        background: #fff;
    }

    body {
        background: #f9fafb
    }

    .product-card,
    .product-widget {
        background: #fff
    }

    .product-img {
        overflow: hidden;
        display: flex;
        justify-content: center
    }

    .product-category {
        height: auto;
        padding: 0;
        margin: 0
    }

    .product-content {
        padding: .875rem
    }

    .product-content1 {
        display: flex;
        justify-content: space-between
    }

    .filters-column-ads .product-widget.mobile,
    .product-button12,
    .product-title.mobile {
        display: none
    }

    .product-category .breadcrumb-item a {
        color: rgb(13 148 136)
    }

    .product-title {
        height: auto;
        font-size: .85rem
    }

    .product-card-column {
        padding: 0 5px
    }

    .product-card {
        margin: 0 0 10px
    }

    .product-price {
        font-size: 14px
    }

    .inner-section {
        margin-bottom: 40px
    }

    .filters-column-ads .product-widget.desktop {
        display: block
    }

    @media only screen and (max-width:737px) {
        .no-result {
            width: 100%;
        }

        .ad-list-part {
            margin-bottom: 100px;
        }

        .filters-column-ads .product-widget.mobile,
        .product-title.mobile {
            display: block
        }

        .filters-column-ads .product-widget.desktop,
        .product-card:hover .product-action,
        .product-title.desktop {
            display: none
        }

        .product-content1 {
            flex-direction: column
        }

        .product-category .breadcrumb-item,
        .product-category li i,
        .product-meta span {
            font-size: 11px
        }

        nav .hidden {
            flex-direction: column;
            margin-bottom: 30px
        }

        .oneline-overflow,
        h3 {
            text-align: center
        }

        .product-img {
            overflow: hidden;
            height: 130px;
            align-content: center;
            background: #fff
        }

        .product-title {
            font-weight: 600;
            font-size: 13px;
            line-height: 20px
        }

        .product-price {
            font-size: 14px
        }

        .product-card-column {
            margin-bottom: 0;
            padding: 0 5px
        }

        .product-card {
            width: auto;
            margin: 0 auto 10px;
            height: auto
        }

        .product-img img {
            width: 100%;
            height: 100%
        }

        .product-btn a,
        .product-btn button {
            margin-left: 0;
            padding-left: 0
        }

        .product-media::before {
            content: none
        }

        .product-card:hover .product-img img {
            transform: none
        }
    }

    .header-filter form {
        justify-content: space-between
    }

    .header-filter {
        display: block
    }

    .col-lg-12 .alert {
        padding: 10px
    }

    .filters-input {
        border: 1px solid #bbbb;
    }

    .filter-button1 {
        display: flex;
        column-gap: 5px
    }

    .filters-column-ads {
        background: #fff;
        padding: 0px;
 
        margin-top: 125px;}

    .filters-column-ads .product-widget {
        background: none;
    margin-bottom: 10px;
    padding: 7px 10px;
    margin-bottom: 0px;
    border: none;
    border-top: 1px solid #f3f3f3;
    border-bottom: 1px solid #f3f3f3
    }
    .product-widget .product-widget-search{display: none;}
    .product-widget-checkbox input, .product-widget-dropitem input {
        width: 12px;
        height: 15px;
        cursor: pointer;
        margin-right: 5px;
    }
    .product-widget-item{margin: 0px;}

    .product-widget-number, .product-widget-text {
        font-size: 12px;
        text-transform: capitalize;
    }
    .product-widget-dropitem {
        margin: 4px 0;
    }
    .product-widget-dropitem button{display: flex;
    justify-content: space-between;    width: 100%;
    font-size: 13px;}
    .product-widget-dropdown{margin: 0px;    padding: 10px 4px;}
    .product-widget-dropdown label{font-size: 12px;
        text-transform: capitalize;}
    .filters-column-ads .product-widget .product-widget-title {
        margin: 0;
        border: none;
        font-size: 13px;
        text-transform: capitalize;
        padding: 6px 0px;
    }

    .filters-column-ads .product-widget .product-widget-title a {
        color: #000;
        display: flex;justify-content: space-between;
        column-gap: 15px
    }

    .filters-column-ads .product-widget.desktop {
        display: block;
    }

    .filters-column-ads .product-widget.mobile {
        display: none;
    }

    .out-of-stock {
        width: 100%;
        display: inline-block;
        padding: 5px 10px;
        background-color: #eb3f33;
        color: white;
        font-weight: bold;
        font-size: 14px;
        border-radius: 5px;
        margin-top: 10px;
        text-align: center;
        text-transform: uppercase;
    }

    .product-listing-button {
        font-size: 13px;
        align-items: center;
        column-gap: 5px;
        width: 100%;
        justify-content: center;
        text-align: center;
        color: #ffffff;
        background: #1c721c;
        padding: 2px 10px;
        border-radius: 5px;
        border: 1px solid #2d6ab3;
    }

    @media only screen and (max-width: 737px) {
        .filters-column-ads {
            margin-top: 0px;}
        .product-title.mobile {
            display: block;
        }

        .product-title.desktop {
            display: none;
        }

        .filters-column-ads .product-widget.desktop {
            display: none;
        }

        .filters-column-ads .product-widget.mobile {
            display: block;
        }
    }
</style>

<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Marketplace</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Marketplace</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="inner-section ad-list-part">
    <div class="container">
        <div class="row">
            @include('website.ads-list.filter')
            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        @include('website.ads-list.active_filters')
                    </div>
                    <div class="col-lg-12">
                            @include('website.ads-list.sort_and_filter')
                    </div> 
                </div>
                <hr> 
                <div class="row mt-4">
                    @forelse($posts as $item)
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-6 product-card-column">
                            <x-product-card :post="$item" />
                        </div> 
                    @empty
                        <div class="col-12">
                            <p class="no-result">No result found.</p>
                        </div>
                    @endforelse
                </div> 
                 
                <div class="pagination-wrapper">
                    {{ $posts->links('components.custom_pagination') }}
                </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="contactSellerModal" tabindex="-1" aria-labelledby="contactSellerModalLabel" aria-hidden="true"  style="display:none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="contactSellerModalLabel">Contact Seller</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contactSellerForm">
                    @csrf
                    <input type="hidden" name="product_slug" id="product_slug">
                    <div style="margin-bottom: 15px;">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Enter Your Name">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="email">Your Email:</label>
                        <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Enter Your Email">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="phone">Your Phone:</label>
                        <input type="tel" id="phone" name="phone" style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;" placeholder="Enter Your Phone Number">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; height: 100px;" placeholder="Enter your message to the seller"></textarea>
                    </div>
                    <div style="text-align: right;">
                        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>


@push('scripts')

@include('layouts.wishlist-script')

<script>
        $(document).ready(function(){function updateIcons(element,show){const icon=$(element).find('i');if(show){icon.removeClass('fa-chevron-down').addClass('fa-chevron-up')}else{icon.removeClass('fa-chevron-up').addClass('fa-chevron-down')}}
$('.collapse').on('show.bs.collapse',function(){updateIcons($(this).prev(),!0)}).on('hide.bs.collapse',function(){updateIcons($(this).prev(),!1)})});
document.addEventListener('DOMContentLoaded',function(){function toggleAccordionCategory(element){const content=document.getElementById(element.getAttribute('aria-controls'));const isExpanded=element.getAttribute('aria-expanded')==='true';const icon=element.querySelector('.toggle-icon-category');if(!isExpanded){element.setAttribute('aria-expanded','true');content.style.display='block';icon.classList.replace('fa-chevron-down','fa-chevron-up')}else{element.setAttribute('aria-expanded','false');content.style.display='none';icon.classList.replace('fa-chevron-up','fa-chevron-down')}}
document.querySelectorAll('.accordion-toggle-category').forEach(toggle=>{toggle.addEventListener('click',function(){toggleAccordionCategory(this)})})});
</script>
<script>
    document.addEventListener('DOMContentLoaded',function(){const clearFilterButton=document.getElementById('clearFilter');if(clearFilterButton){clearFilterButton.addEventListener('click',function(){document.querySelectorAll('.product-widget-checkbox input[type="checkbox"]').forEach(input=>{input.checked=!1})})}});document.addEventListener('DOMContentLoaded',function(){const clearFilterButton=document.getElementById('clearFilter');if(clearFilterButton){clearFilterButton.addEventListener('click',function(){document.querySelectorAll('.product-widget-checkbox input[type="checkbox"]').forEach(input=>{input.checked=!1})})}})
</script>
<script>document.addEventListener('DOMContentLoaded',function(){const lazyImages=document.querySelectorAll('img.lazy-load'),placeholder='{{ asset("storage/placeholder-image.webp") }}';lazyImages.forEach(img=>{img.setAttribute('loading','lazy'),img.setAttribute('src',placeholder)});if('IntersectionObserver'in window){let lazyImageObserver=new IntersectionObserver(function(entries,observer){entries.forEach(function(entry){if(entry.isIntersecting){let img=entry.target;const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='https://eversabz.com/storage/no-image.jpg'},img.classList.remove('lazy-load'),lazyImageObserver.unobserve(img)}})});lazyImages.forEach(function(img){lazyImageObserver.observe(img)})}else lazyImages.forEach(function(img){const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='https://eversabz.com/storage/no-image.jpg'},img.classList.remove('lazy-load')})});

$(document).ready(function () {
    function initializeContactSeller() {
        const $contactLinks = $('.contact-seller');
        const $productSlugInput = $('#product_slug');
        const contactSellerModal = new bootstrap.Modal(document.getElementById('contactSellerModal'));

        $contactLinks.on('click', function (e) {
            e.preventDefault();
            const productSlug = $(this).data('product-slug');
            if (productSlug && $productSlugInput.length) {
                $productSlugInput.val(productSlug);
            }
            contactSellerModal.show();
        });

        $('#contactSellerForm').on('submit', function (e) {
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: '/contact-seller',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': APP_DATA.csrfToken,
                    'Accept': 'application/json'
                },
                success: function (response) {
                    if (response.success) {
                        showNotification(response.message);
                        contactSellerModal.hide();
                        $('#contactSellerForm')[0].reset();
                    } else {
                        showNotification(response.message || 'An error occurred', 'error');
                    }
                },
                error: function () {
                    showNotification('An error occurred. Please try again.', 'error');
                }
            });
        });
    }

    initializeContactSeller();
});



</script>

@endpush
@endsection
