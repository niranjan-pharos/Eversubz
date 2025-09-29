@extends('frontend.template.master')
@section('title',  "My Posts")

@section('content')

@include('frontend.template.usermenu')

<link rel="stylesheet" href="assets/css/custom/my-ads.css">
<style> 
body{background:#F9FAFB}.product-widget,.product-card{background:#fff}.product-img{overflow:hidden;display:flex;justify-content:center}.product-category{height:auto;padding:0;margin:0}.product-content{padding:.875rem}.product-content1{display:flex;justify-content:space-between}.wishlistButton{display:none}.product-category .breadcrumb-item a{color:#0d9488}.product-title{height:auto;font-size:.85rem}.product-card-column{padding:0 5px}.product-card{margin:0 0 10px}.product-price{font-size:14px}.product-title.mobile{display:none}@media (max-width:575px){.product-title.mobile{display:block}.product-title.desktop{display:none}.product-content1{flex-direction:column}.product-meta span{font-size:11px}.expiry-date{float:left}.product-meta{column-gap:17px;margin-bottom:5px;line-height:20px}.product-card-column{margin-bottom:0;padding:0 5px}.product-card{width:auto;margin:0 auto 10px;height:auto}.product-img{overflow:hidden;height:130px;align-content:center;background:#fff}.product-img img{width:100%;height:100%}.product-title{font-weight:600;font-size:13px;line-height:20px}.product-category{margin-bottom:1px;line-height:17px}.product-category .breadcrumb-item{font-size:11px}.product-price{font-size:14px}.product-category li i{font-size:11px}.product-meta span{margin-right:0}.myads-part{margin-bottom: 75px;}}
</style>

<section class="myads-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-filter">
                    <div class="filter-show"><label class="filter-label">Show :</label>
                        <select class="custom-select filter-select" id="resultsPerPage">
                            <option value="10" {{ config('constants.DEFAULT_PAGINATION') == 10 ? 'selected' : '' }}>10
                            </option>
                            <option value="20" {{ config('constants.DEFAULT_PAGINATION') == 20 ? 'selected' : '' }}>20
                            </option>
                            <option value="30" {{ config('constants.DEFAULT_PAGINATION') == 30 ? 'selected' : '' }}>30
                            </option>
                            <option value="40" {{ config('constants.DEFAULT_PAGINATION') == 40 ? 'selected' : '' }}>40
                            </option>
                            <option value="50" {{ config('constants.DEFAULT_PAGINATION') == 50 ? 'selected' : '' }}>50
                            </option>
                        </select>
                    </div>
                    <div class="filter-short">
                        <label class="filter-label">Short by :</label>
                        <select class="custom-select filter-select" id="postFilter">
                            <option selected data-filter="all"
                                {{ request()->query('filter') == 'all' ? 'selected' : '' }}>All Ads</option>
                            <option value="3" data-filter="Booking"
                                {{ request()->query('filter') == 'Booking' ? 'selected' : '' }}>Booking Ads</option>
                            <option value="2" data-filter="Rent"
                                {{ request()->query('filter') == 'Rent' ? 'selected' : '' }}>Rental Ads</option>
                            <option value="1" data-filter="Sale"
                                {{ request()->query('filter') == 'Sale' ? 'selected' : '' }}>Sale Ads</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row  ad-standard"> by adding ad-standard class data is not showing--}}
        <div class="row">
            @foreach($posts as $post)
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-6 product-card-column">
                <x-product-card :post="$post" />

            </div>

            @endforeach

        </div> 

        {{-- pagination --}}
        @include('components.custom_pagination', ['paginator' => $posts])


    </div>
</section>


<script>
$(document).ready(function () {
    $("#resultsPerPage").on("change", function () {
        var resultsPerPage = $(this).val();
        var currentUrl = window.location.href;
        var updatedUrl = updateQueryStringParameter(currentUrl, "per_page", resultsPerPage);
        window.location.href = updatedUrl;
    });
    $("#postFilter").on("change", function () {
        var filterValue = $(this).find(":selected").data("filter");
        var currentUrl = window.location.href;
        var updatedUrl = updateQueryStringParameter(currentUrl, "filter", filterValue);
        window.location.href = updatedUrl;
    });
    function updateQueryStringParameter(url, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = url.indexOf("?") !== -1 ? "&" : "?";
        if (url.match(re)) {
            return url.replace(re, "$1" + key + "=" + value + "$2");
        } else {
            return url + separator + key + "=" + value;
        }
    }
});
$(document).ready(function () {
    var urlSearchParams = new URLSearchParams(window.location.search);
    var perPageParam = urlSearchParams.get("per_page");
    if (perPageParam) {
        $("#resultsPerPage").val(perPageParam);
    }
});
$(document).ready(function () {
        $(".deleteForm").on("submit", function (e) {
            e.preventDefault();
            var form = $(this);
            var deleteButton = form.find(".deleteButton");
            if (confirm("Are you sure you want to delete this item?")) {
                deleteButton.attr("disabled", true);
                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                           
                            form.closest('.product-card').remove();
                        } else {
                            toastr.error(response.message || "An error occurred. Please try again.");
                        }
                    },
                    error: function (xhr) {
                        toastr.error("An error occurred. Please try again.");
                    },
                    complete: function () {
                        deleteButton.attr("disabled", false);
                    },
                });
            }
        });
    });


</script>

<script>document.addEventListener('DOMContentLoaded',function(){const lazyImages=document.querySelectorAll('img.lazy-load'),placeholder='{{ asset("storage/placeholder-image.webp") }}';lazyImages.forEach(img=>{img.setAttribute('loading','lazy'),img.setAttribute('src',placeholder)});if('IntersectionObserver'in window){let lazyImageObserver=new IntersectionObserver(function(entries,observer){entries.forEach(function(entry){if(entry.isIntersecting){let img=entry.target;const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='https://eversabz.com/storage/no-image.jpg'},img.classList.remove('lazy-load'),lazyImageObserver.unobserve(img)}})});lazyImages.forEach(function(img){lazyImageObserver.observe(img)})}else lazyImages.forEach(function(img){const realSrc=img.getAttribute('data-src');img.src=realSrc,img.onerror=function(){img.src='https://eversabz.com/storage/no-image.jpg'},img.classList.remove('lazy-load')})});</script>
@endsection