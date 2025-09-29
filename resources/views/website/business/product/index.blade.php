@extends('frontend.template.master')
@section('title', 'Shop Sustainable Products Online | Eversabz Eco-Friendly Store')
@section('description', 'Explore a wide range of eco-friendly products at Eversabz. Shop sustainable items that are good for you and the planet. Discover quality and green living today!')
@section('content')

<style>
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
    .out-of-stock a{color: #fff;}
    .no-result{color: #000;font-size: 16px; text-align: center;width: 320px;padding: 13px;border: 1px solid #2d64af;border-radius:7px;background: #fff;}
body{background:#f9fafb}.product-card,.product-widget{background:#fff}.product-img{overflow:hidden;display:flex;justify-content:center}.product-category{height:auto;padding:0;margin:0}.product-content{padding:.875rem .875rem 10px}.product-content1{display:flex;justify-content:space-between}.product-category .breadcrumb-item a{color:rgb(13 148 136)}.product-title{height:auto;font-size:.85rem}.product-card{margin:0 0 10px;height:100%}.product-price{font-size:14px}.inner-section{margin-bottom:40px}.product-button12{display:none!important}.product-img img{width:100%;height:200px;object-fit:contain}.header-filter{display:block}.header-filter form{justify-content:space-between}.product-card-column{padding:0 5px;margin:0 0 10px}.product-img-card12{height:200px}.product-img-card12 img{height:100%!important;object-fit:contain}@media (max-width:575px){.no-result{width: 100%;}.product-content1{flex-direction:column}.expiry-date{float:left}.product-meta span{margin-right:0}.product-img{overflow:hidden;height:130px;align-content:center;background:#fff}.product-title{height:50px;font-weight:600;font-size:13px;line-height:20px}.product-category{margin-bottom:1px;line-height:17px}.product-category .breadcrumb-item,.product-category li i{font-size:11px}.product-price{font-size:14px}.product-btn-group{text-align:end;margin-top:-25px}.product-card-column{margin-bottom:0;padding:0 5px}.product-card{width:auto;margin:0 auto 10px;height:auto}.product-img img{width:100%;height:100%}.product-btn a,.product-btn button{margin-left:0;padding-left:0}.product-meta{column-gap:17px;display:flex;margin-bottom:0;line-height:20px}h3{text-align:center}.product-card:hover .product-action{display:none}.product-media::before{content:none}.product-card:hover .product-img img{transform:none}}

.filters-input{border:1px solid #bbbb}.filter-button1{display:flex;column-gap:5px}.filters-column-ads{background:#fff;padding:0px}.filters-column-ads .product-widget{background:0 0;padding:5px;border:none;margin-bottom:10px}.filters-column-ads .product-widget .product-widget-title{font-size:15px}.filters-column-ads .product-widget .product-widget-title a{color:#000;display:flex;column-gap:15px}.filters-column-ads .product-widget.desktop{display:block}.filters-column-ads .product-widget.mobile{display:none}@media only screen and (max-width:737px){.filters-column-ads .product-widget.mobile,.product-title.mobile{display:block}.filters-column-ads .product-widget.desktop,.product-title.desktop{display:none}}


</style>
<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Product list</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>  
                        <li class="breadcrumb-item active" aria-current="page">Product list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> 
</section>
<section class="inner-section ad-list-part">
    <div class="container">
        <div class="row ">
            @include('website.business.product.filter')
            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-filter">
                            <form action="{{ route('product.filter') }}" method="GET" class="d-flex">
                                <div class="filter-show">
                                    <label class="filter-label">Show :</label>
                                    <select name="perPage" class="custom-select filter-select"
                                        onchange="this.form.submit()">
                                        <option value="12" {{ request('perPage') == '12' ? 'selected' : '' }}>12
                                        </option>
                                        <option value="24" {{ request('perPage') == '24' ? 'selected' : '' }}>24
                                        </option>
                                        <option value="36" {{ request('perPage') == '36' ? 'selected' : '' }}>36
                                        </option>
                                    </select>
                                </div>
                                <div class="filter-short ml-3">
                                    <label class="filter-label">Sort by :</label>
                                    <select name="sortBy" class="custom-select filter-select"
                                        onchange="this.form.submit()">
                                        <option>Default</option>
                                        <option value="1" {{ request('sortBy') == '1' ? 'selected' : '' }}>A-Z</option>
                                        <option value="2" {{ request('sortBy') == '2' ? 'selected' : '' }}>Z-A</option>
                                    </select>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                
                <div class="row">
                    @forelse($products as $product)
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-6 product-card-column">
                        <x-business-product-card class="standard" :product="$product" />
                    </div>

                    @empty
                    <div class="col-12">
                            <p class="no-result">No result found.</p>
                        </div>
                    @endforelse
                </div>


                <div class="pagination-wrapper">
                    {{ $products->links('components.custom_pagination') }}
                </div>
            </div>
        </div>
    </div>
</section>

@section('modals')
<!-- Contact Seller Modal -->
<div id="contactSellerModal" class="modal" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div class="modal-content" style="background: white; padding: 20px; border-radius: 5px; width: 90%; max-width: 500px;">
        <h3 class="mb-2 font-bold">Contact Seller</h3>
        <form id="contactSellerForm">
            @csrf
            <input type="hidden" name="product_slug" id="product_slug">
            <div style="margin-bottom: 15px;">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required style="width: 100%; padding: 8px;" placeholder="Enter Your Name">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 8px;" placeholder="Enter Your Email">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="phone">Your Phone:</label>
                <input type="tel" id="phone" name="phone" style="width: 100%; padding: 8px;" placeholder="Enter Your Phone Number">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="message">Message:</label>
                <textarea id="message" name="message" style="width: 100%; padding: 8px;" placeholder="Enter your message to the seller"></textarea>
            </div>
            <div style="text-align: right;">
                <button type="button" id="closeModal" style="padding: 8px 16px; margin-right: 10px;">Cancel</button>
                <button type="submit" style="padding: 8px 16px; background: #28a745; color: white; border: none;">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
@include('layouts.wishlist-script')

<script>
    $(document).ready(function() {
        function updateIcons(element, show) {
            const icon = $(element).find('i');
            if (show) {
                icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            } else {
                icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            }
        }
    
        $('.collapse')
            .on('show.bs.collapse', function() {
                updateIcons($(this).prev(), true);
            })
            .on('hide.bs.collapse', function() {
                updateIcons($(this).prev(), false);
            });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lazyImages = document.querySelectorAll('img.lazy-load');
        const placeholder = '{{ asset("storage/placeholder-image.webp") }}';
        const $contactLinks = $('.contact-seller');
        const $modal = $('#contactSellerModal');
        const $form = $('#contactSellerForm');
        const $closeModalBtn = $('#closeModal');
        const $productSlugInput = $('#product_slug');
    
        lazyImages.forEach(img => {
            img.setAttribute('loading', 'lazy');
            img.setAttribute('src', placeholder);
        });
    
        if ('IntersectionObserver' in window) {
            let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let img = entry.target;
                        const realSrc = img.getAttribute('data-src');
                        img.src = realSrc;
                        img.onerror = function() {
                            img.src = '{{ asset("storage/no-image.jpg") }}';
                        };
                        img.classList.remove('lazy-load');
                        lazyImageObserver.unobserve(img);
                    }
                });
            });
    
            lazyImages.forEach(function(img) {
                lazyImageObserver.observe(img);
            });
        } else {
            lazyImages.forEach(function(img) {
                const realSrc = img.getAttribute('data-src');
                img.src = realSrc;
                img.onerror = function() {
                    img.src = '{{ asset("storage/no-image.jpg") }}';
                };
                img.classList.remove('lazy-load');
            });
        }

        $contactLinks.on('click', function(e) {
            e.preventDefault();
            const productSlug = $(this).data('product-slug');
            console.log('Contact seller clicked:', productSlug);
            $productSlugInput.val(productSlug);
            $modal.css('display', 'flex');
        });

        $closeModalBtn.on('click', function() {
            console.log('Close modal clicked');
            $modal.css('display', 'none');
            $form[0].reset();
        });

        $form.on('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
            const formData = $(this).serialize();

            $.ajax({
                url: '/contact-seller',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log('AJAX success:', data);
                    if (data.success) {
                        toastr.success(data.message);
                        $modal.css('display', 'none');
                        $form[0].reset();
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', xhr.responseText);
                    toastr.error('An error occurred. Please try again.');
                }
            });
        });

        $modal.on('click', function(e) {
            if ($(e.target).is($modal)) {
                console.log('Clicked outside modal');
                $modal.css('display', 'none');
                $form[0].reset();
            }
        });
    });
</script>
@endpush


@endsection