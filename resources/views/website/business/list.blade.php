@extends('frontend.template.master')
@section('title', 'Explore Top Business Listings | Eversabz Directory')
@section('description', 'Discover a comprehensive list of businesses on Eversabz. Find the best services and products tailored to your needs. Explore now for quality and reliability!')
@section('content')
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

    .product-card .product-media a {
        display: flex;
        justify-content: center
    }

    .filter-short {
        float: right;
        margin-top: -40px;
    }

    .header-filter {
        display: block;
    }

    .section-body a {
        text-decoration: none;
        color: black;
    }

    .product-card-column {
        padding: 0px 5px;
    }

    .product-card {
        margin: 0px 0px 10px;
    }

    .inner-section {
        margin-bottom: 40px;
    }

    .product-category {
        height: auto;
        padding: 0px;
        margin: 0px;
    }

    .product-category .breadcrumb-item {
        font-size: 13px;
        color: rgb(13 148 136);
        white-space: normal;
    }

    .product-content {
        padding: 0.875rem;
    }

    .product-title {
        height: auto;
        font-size: 0.85rem;
        margin: 0px;
    }

    .product-meta {
        margin-bottom: 0px;
    }

    .double-hr {
        border-top: 3px double #8c8b8b;
    }

    /* CARD SETUP STYLES */
    .card1 {
        background-color: #f5f5f5;
        width: 100%;
        margin: 1rem auto;
        /* -webkit-box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22); box-shadow: 0 4px 18px rgba(0, 0, 0, 0.25), 0 5px 5px rgba(0, 0, 0, 0.22); */
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        background: #eee;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all linear .3s;
        -webkit-transition: all linear .3s;
        border-bottom: 3px solid #04b;
    }

    .card1:hover {
        -webkit-box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.1);
        transform: translateY(-0.5rem);
        background-color: #fff;
        box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.1);
        border-bottom: 5px solid #04b;
    }

    .display-div1 {
        display: flex;
        column-gap: 15px;
    }

    .img-circle img {
        width: 80px;
        height: auto;
        border-radius: 10px;
        background-clip: padding-box;
        background-size: cover;
        background-position: center center;
        text-align: center;
        margin: 0 auto;
    }

    /* @media only screen and (min-width: 737px) { .img-circle img { margin-left: 1rem; margin-right: 2rem; } } */
    .oneline-overflow {
        overflow: auto;
    }

    /* ICON CONTAINER STYLES */
    .section-break {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icon-spacing {
        margin: 10px;
        padding: 10px;
        border: none;
        background: #0044bb;
        color: #fff ! IMPORTANT;
    }

    .icon-spacing:hover {
        background: #0022aa;
    }

    @media only screen and (max-device-width: 737px) {
        .no-result {
            width: 100%;
        }

        .icon-spacing {
            margin: 0.5em 0.5em 0.5em 0.5em;
        }
    }

    .icon-container {
        text-align: center;
        width: 100%;
    }

    .container-1 {
        margin-bottom: 1em;
    }

    /* SOCIAL MEDIA ICON COLORS */
    .facebook {
        background-color: #3b5998 !important;
        color: #fff !important;
    }

    .facebook i {
        color: #fff !important;
    }

    .facebook:hover {
        background-color: #4c70ba !important;
    }

    .github {
        background-color: #444444 !important;
        color: #fff !important;
    }

    .github i {
        color: #fff !important;
    }

    .github:hover {
        background-color: #5e5e5e !important;
    }

    .instagram {
        background-color: #405de6 !important;
        color: #fff !important;
    }

    .instagram i {
        color: #fff !important;
    }

    .instagram:hover {
        background-color: #6d83ec !important;
    }

    .linkedin {
        background-color: #007bb6 !important;
        color: #fff !important;
    }

    .linkedin i {
        color: #fff !important;
    }

    .linkedin:hover {
        background-color: #009de9 !important;
    }

    .twitter {
        background-color: #55acee !important;
        color: #fff !important;
    }

    .twitter i {
        color: #fff !important;
    }

    .twitter:hover {
        background-color: #83c3f3 !important;
    }

    .website-link {
        display: flex;
        align-items: center;
    }

    .product-img {
        overflow: hidden;
        height: 200px;
        align-content: center;
        background: white;
    }

    .website-link {
        overflow-wrap: anywhere;
        line-height: 14px;
    }

    .website-link:hover {
        color: blue;
        text-decoration: underline;
    }

    /* .product-img { overflow: hidden; height: 202px; } .product-img img { width: 100%; transition: all linear .5s; height: 100%; } */
    .filter-button1 {
        display: flex;
        column-gap: 5px
    }

    .product-widget-list input[type="checkbox"] {
        width: 12px;
    height: 15px;
    cursor: pointer;
    margin-right: 5px;
    }
    .product-widget-list label{    font-size: 12px;
        text-transform: capitalize;}
    .product-widget-list li {}

    .product-widget-list li,
    .product-widget-list input[type="checkbox"],
    .product-widget-list label {
        cursor: pointer;
    }

    svg {
        height: 20px;
    }

    nav .flex {
        display: none;
    }

    nav .hidden {
        padding-top: 30px;
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    nav .hidden div p {
        font-weight: 500;
        color: var(--gray);
    }

    .pagination-padding-1 {
        margin: 0px 1px;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        position: relative;
        font-weight: 500;
        border: none;
        padding: 0px !important;
        color: var(--gray);
        background: var(--white);
    }

    .pagination-active {
        background-color: #3490dc;
        /* Custom background color */
        color: white;
        /* White text color */
        border-color: #3490dc;
        /* Border color to match the background */
        font-weight: bold;
        /* Bold text */
        border-radius: 50%;
        padding: 7px 14px !IMPORTANT;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        position: relative;
        /* Rounded corners */
    }

    .pagination-padding-2 {
        display: inline-block;
    }

    body {
        background: #F9FAFB;
    }

    .product-widget,
    .product-card {
        background: #fff;
    }
    .filters-column-ads {
        padding: 20px 20px 30px 20px !important;
    background: white;
    border-radius: 10px !important;
    margin-top:60px;
    }

        .jbs-grid-usrs-thumb {
        width: 100%;
        height: 250px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        border-radius: 0 !important;
    }
    .btn-new-one {
        padding: 9px 12px !important;
    }

    .jbs-grid-usrs-thumb img {
        height: 100%;
        width: auto;
        object-fit: cover;
        border-radius: 0 !important;
    }



    @media only screen and (max-width: 737px) {
        .filters-column-ads {
            margin-top: 0px;}
        nav .hidden {
            flex-direction: column;
            margin-bottom: 30px;
        }

        .oneline-overflow {
            text-align: center;
        }

        .product-img {
            overflow: hidden;
            height: 130px;
            align-content: center;
            background: white;
        }

        .product-title {
            /* height: 50px; */
            font-weight: 600;
            font-size: 13px;
            line-height: 20px;
        }

        .product-meta span {
            font-size: 11px;
        }

        .product-category {
            margin-bottom: 1px;
            line-height: 17px;
        }

        .product-category .breadcrumb-item {
            font-size: 11px;
        }

        .product-price {
            font-size: 14px;
        }

        .product-category li i {
            font-size: 11px;
        }

        .product-card-column {
            margin-bottom: 0px;
            padding: 0px 5px;
        }

        .product-card {
            width: auto;
            margin: 0px auto 10px;
            height: auto;
        }

        .product-img img {
            width: 100%;
            height: 100%;
        }

        .product-info {
            display: block;
            padding: 4px 0px;
        }

        .product-btn a,
        .product-btn button {
            margin-left: 0px;
            padding-left: 0px;
        }

        .product-meta {
            margin-bottom: 0px;
            line-height: 20px;
        }

        h3 {
            text-align: center;
        }
    }
</style>
<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>business List</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">business List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-body inner-section">
    <div class="container">
        <div class="row">
            {{-- filter --}}
            <div class="col-lg-4 col-xl-3">
                <div class="row">
                    <div class="col-md-6 col-lg-12 filters-column-ads">
                         <div class="col-lg-12 text-center">
                           <a href="{{ route('business-info.index') }}" class="btn btn-new-one">Add Your Business</a>
                         </div>
                        <x-business-category-filter :categories="$categories" action="{{ route('business.list') }}" />

                        <x-business-city-filter :topCities="$topCities" action="{{ route('business.list') }}" />

                        <x-business-state-city-filter :statesWithCities="$statesWithCities"
                            action="{{ route('business.list') }}" />






                    </div>
                </div>
            </div>


            {{-- //filter --}}

            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-filter">
                            <form action="{{ route('business.list') }}" method="GET">
                                <div class="filter-show">
                                    <label class="filter-label">Show :</label>
                                    <select name="perPage" class="custom-select filter-select"
                                        onchange="this.form.submit()">
                                        <option value="12" {{ request('perPage')=='12' ? 'selected' : '' }}>12</option>
                                        <option value="24" {{ request('perPage')=='24' ? 'selected' : '' }}>24</option>
                                        <option value="36" {{ request('perPage')=='36' ? 'selected' : '' }}>36</option>
                                    </select>
                                </div>
                                <div class="filter-short ml-3">
                                    <label class="filter-label">Sort by :</label>
                                    <select name="sortBy" class="custom-select filter-select"
                                        onchange="this.form.submit()">
                                        <option>Default</option>
                                        <option value="1" {{ request('sortBy')=='1' ? 'selected' : '' }}>A-Z</option>
                                        <option value="2" {{ request('sortBy')=='2' ? 'selected' : '' }}>Z-A</option>
                                    </select>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>

                <div class="row">
                    @if(isset($businessInfos) && $businessInfos->count() > 0)
                    @foreach($businessInfos as $post)
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 col-6 product-card-column">
                        <x-business-card :post="$post" />
                    </div>
                    @endforeach
                    @else
                    <div class="col-12">
                            <p class="no-result">No result found.</p>
                        </div>

                    @endif

                </div>
 
                {{-- {{ $businessInfos->appends(request()->query())->links() }} --}}
                <div class="pagination-wrapper">
                    {{ $businessInfos->links('components.custom_pagination') }}
                </div>

            </div>

        </div>
    </div>
</section>




@endsection