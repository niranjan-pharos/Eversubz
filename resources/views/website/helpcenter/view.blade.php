@extends('frontend.template.master')
@section('content')
@push('style')

<style>
    .section-1 {
        background: #f5f5f5;
        padding: 75px 0px;
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

    .card-header {
        margin-bottom: 0px;
    }

    .section-1 .col-md-8 .card {
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

    .accordion-button {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;width: 100%;    
        padding: 10px;
        border-bottom: 1px solid #bbb;
        margin-bottom: 10px;background: #17a2b830;
    }

    .accordion-button::after {
        content: '\25B2';
        /* Unicode character for right-pointing triangle */
        font-size: 1rem;
        color: #333;
        margin-left: auto;
        transition: transform 0.3s ease;
    }

    .accordion-button:not(.collapsed)::after {
        content: '\25B2';
        /* Unicode character for down-pointing triangle */
        transform: rotate(0);
    }

    .accordion-button.collapsed::after {
        transform: rotate(-180deg);
    }
    .accordion-collapse.collapse.show {
        padding-bottom: 20px;
        border-bottom: 1px solid;
        margin-bottom: 20px;
    }

    .accordion-body img {
        border: 2px solid blue;
        border-radius: 5px;
    }
    @media only screen and (max-width: 767px){
        .col-md-8{margin-top: 20px;}
    }
</style>
@endpush
<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>{{ $subcategory->name }}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('helpcenter.list') }}">Help Center</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subcategory->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-1">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
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
        <!-- Check if the category contains the active subcategory -->
        @php
            $isCategoryActive = $category->subcategories->contains('id', $subcategory->id);
        @endphp

        @if ($category->subcategories->contains(function ($sub) { return $sub->faqs->count() > 0; }))
            <button class="" type="button" data-toggle="collapse" data-target="#category-{{ $category->id }}"
                aria-expanded="{{ $isCategoryActive ? 'true' : 'false' }}"
                aria-controls="category-{{ $category->id }}">
                {{ $category->name }}
            </button>

            <div class="collapse {{ $isCategoryActive ? 'show' : '' }}" id="category-{{ $category->id }}">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    @foreach ($category->subcategories as $sub)
                        @if ($sub->faqs->count() > 0) <!-- Check if subcategory has FAQs -->
                            <a class="nav-link {{ $sub->id === $subcategory->id ? 'active' : '' }}"
                               href="{{ route('helpcenter.subcategory', $sub->slug) }}">
                               {{ $sub->name }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>

            </div>

            <!-- Content -->
            <div class="col-md-8">
                <div class="tab-content">
                    <div class="card">
                        
                        <div class="card-body">
                            @if ($subcategory->faqs->count())
                            <div class="accordion" id="faqAccordion">
                                @foreach ($subcategory->faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h5 class="accordion-header" id="heading-{{ $index }}">
                                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse-{{ $index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h5>
                                    <div id="collapse-{{ $index }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        aria-labelledby="heading-{{ $index }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p>No FAQs available for this subcategory.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endpush


@endsection