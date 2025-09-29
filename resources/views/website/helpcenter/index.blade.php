@extends('frontend.template.master')

@section('content')

<style>
    .section-1 {
        background: #f5f5f5;
        padding: 75px 40px;
    }

    .section-1 .nav-pills {
        background: #fff;
        justify-content: flex-start;
        align-items: normal;
    }

    .section-1 .nav-pills button {
        padding: 10px 15px;
        border-bottom: 1px solid #bbb;
        width: 100%;
        text-align: left;
        display: block;
        padding: 1.25rem 1rem 1rem;
        line-height: 1;
        font-weight: 500;
        font-size: 14px;
        transition: 0.5s;
        color: #333;
        border-left: 4px solid transparent;
    }

    .section-1 .nav-pills button:hover {
        background: #2c54a4;
        color: #fff;
    }

    .section-1 .nav-pills button[aria-expanded="true"] {
        background: #007bff;
        color: #fff;
        font-weight: bold;
        border-left: 4px solid #0056b3;
        border-bottom: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .section-1 .nav-pills .nav-link {
        font-size: 14px;
        color: #000;
        padding: 6px 0px 6px 2rem;
    }

    .section-1 .nav-pills .nav-link.active,
    .section-1 .nav-pills .show>.nav-link,
    .section-1 .nav-pills .nav-link:hover {
        background-color: transparent;
        color: #007bff;
        font-size: 14px;
        font-weight: bold;
    }

    .section-1 .tab-pane {
        padding: 20px;
    }
    .card-header{margin-bottom: 0px;}

    .section-1 .col-md-8 .card {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .section-1 .col-md-8 .card h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .section-1 .col-md-8 .card p {
        font-size: 15px;
    }

    /* Additional Styles for Open Category Button */
    .section-1 .nav-pills button[aria-expanded="true"]::after {
        content: "▼";
        float: right;
        font-size: 12px;
        margin-left: 10px;
    }

    .section-1 .nav-pills button[aria-expanded="false"]::after {
        content: "►";
        float: right;
        font-size: 12px;
        margin-left: 10px;
    }

    .card1 {
        background-color: #215070;
        display: table;
        width: 100%;
        height: 75px;
        color: #3498db;
        overflow: hidden;
        margin-bottom: 30px;
        border-radius: 3px;
    }

    .card1 .icon1 {
        width: 48px;
        height: 100%;
        display: table-cell;
        position: relative;
        background-color: currentColor;
    }

    .card1 .icon1:after {
        content: '';
        height: 100%;
        width: 0;
        position: absolute;
        right: -90px;
        top: 0;
        border-right: 90px solid transparent;
        border-left: 0px;
        border-bottom: 272px solid currentColor;
    }

    .card1 .icon1 i {
        position: absolute;
        bottom: 25px;
        left: 12px;
        color: #fff;
        font-size: 28px;
        z-index: 1;
    }

    .card1 .content-wrap1 {
        padding: 20px;
        padding-left: 50px;
        display: table-cell;
        vertical-align: middle;
    }

    .card1 .content-wrap1 .item-title1 {
        display: inline-block;
        font-size: 21px;
        color: #fff;
        margin-bottom: 3px;
    }

    .card1 .content-wrap1 .text1 {
        color: #fff;
        font-size: 15px;
    }


    @media only screen and (max-width: 767px) {
        .section-1{
            padding: 60px 0px !important;
        }

        .card1 .content-wrap1 {
            padding: 41px !important;
        }

        .card1 .icon1 i {
            font-size: 35px !important;
        }

        .marginadjustformobile{
            margin-top: 10% !important;
        }
    }
</style>
<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Help Center</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('helpcenter.list') }}">Help Center</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-1">
    <div class="container">
        <div class="row">
            <!-- Categories and Subcategories -->
            <div class="col-md-4">
            <a href="https://eversabz.com/contactus">
                    <div class="card1">

                        <span class="icon1">
                            <i class="fa fa-phone"></i>
                        </span>
                        <div class="content-wrap1">
                            <span class="item-title1">
                                Contact Us
                            </span>
                            <p class="text1">
                                We always are available to help you.
                            </p>
                        </div>
                    </div>
                    </a>
                    
                    <div class="nav-pills">
    @foreach ($faqCategories as $category)
        @php
            // Check if the category has any subcategory with FAQs
            $hasSubcategoriesWithFAQs = $category->subcategories->contains(function ($subcategory) {
                return $subcategory->faqs->count() > 0;
            });
        @endphp

        @if($hasSubcategoriesWithFAQs) <!-- Only display the category if it has subcategories with FAQs -->
            <button class="" type="button" data-toggle="collapse" data-target="#category-{{ $category->id }}"
                aria-expanded="false" aria-controls="category-{{ $category->id }}">
                {{ $category->name }}
            </button>

            <div class="collapse" id="category-{{ $category->id }}">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    @foreach ($category->subcategories as $subcategory)
                        @if($subcategory->faqs->count() > 0)  <!-- Only show subcategories with FAQs -->
                            <a class="nav-link" href="{{ route('helpcenter.subcategory', $subcategory->slug) }}">
                                {{ $subcategory->name }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>

            </div>

            <div class="col-md-8">
                <div class="card marginadjustformobile">
                    <h3>Discover Everything You Need on Eversabz</h3>
                    <p>Eversabz is your go-to destination for all things shopping, offering an impressive selection of categories like Electronics, Culinary Delights, Entertainment, Sports Gear, Automotive Essentials, Fashion Trends, Home Décor, and much more. Our platform connects buyers and sellers effortlessly, creating a seamless experience where you can explore, compare, and shop for a variety of products and services.</p>
                    <p>From finding cutting-edge gadgets to planning an unforgettable dining adventure or refreshing your wardrobe, Eversabz simplifies it all. Dive into a world of convenience and possibilities with Eversabz—your ultimate marketplace for all your needs in one place.</p>
                </div>
            </div>
        </div>
    </div>
</section>






@endsection