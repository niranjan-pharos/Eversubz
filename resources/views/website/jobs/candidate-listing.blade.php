@extends('frontend.template.master')


@section('title', 'Jobs')
@section('description', 'Welcome to Eversubz')

@section('content')
@push('style')

<style>
    .main-section2 {
        background: #f1f5f8 !important;
        padding: 80px 0 80px;
    }

    .form-control {
        height: 40px;
        border-radius: 6px;
        width: 100%;
        background: var(--white);
        border: 1px solid #eeeeee;
    }

    .product-widget {
        padding: 5px 10px;
        background: #ffffff;
        margin-bottom: 0px;
        border: 1px solid #f3f3f3;
    }

    .product-widget-title {
        margin: 0;
        border: none;
        font-size: 13px;
        text-transform: capitalize;
        padding: 6px 0px;
    }

    .filter-list li {
        font-size: 12px;
    }

    .form-check-input {
        position: inherit;
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 5px;
    }

    .single-banner {
        margin-bottom: 0px;
    }

    .jbs-grid-usrs-block {
        position: relative;
        display: flex
    ;
        flex-direction: column;
        width: 100%;
        background: #ffffff;
        border-radius: 0.6rem;
        padding: 1.5rem 12px;;
    }
    .jbs-grid-usrs-thumb {
        position: relative;
        display: flex
    ;
        flex-direction: column;
        width: 100%;
        margin: 0 auto 0.5rem;
    }
    .jbs-grid-yuo {
        display: flex
    ;
        align-items: center;
        justify-content: center;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto;
    }
    .jbs-grid-yuo figure {
        margin: 0;
    }
    .circle {
        border-radius: 100%;
    }
    .jbs-grid-usrs-caption {
        position: relative;
        width: 100%;
        display: flex
    ;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2.5rem;
    }.jbs-tiosk {
        position: relative;
        display: flex
    ;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
    }.jbs-tiosk .jbs-tiosk-title {
        font-size: 17px;
        margin: 0;
        line-height: 1.5;
    }.jbs-tiosk .jbs-tiosk-subtitle {
        font-size: 12px;
        font-weight: 500;
        color: rgba(0, 44, 63, 0.6);
    }.jbs-grid-job-edrs {
        position: relative;
        width: 100%;
        display: flex
    ;
        align-items: flex-start;
        justify-content: flex-start;
        margin-bottom: 1.8rem;
    }.jbs-grid-job-edrs-group.center {
        align-items: center;flex-flow: wrap;
        justify-content: center;    display: flex
        ;
    }
    .col-lg-8.col-xl-8 {
        padding: 0px 5px;
    }
    .col-xl-4.col-lg-6.col-md-6.col-6 {
        padding: 0px 5px;
    }
    .jbs-grid-job-edrs-group span {
        display: inline-flex
    ;
        align-items: center;
        justify-content: center;
        height: 23px;
        width: auto;
        padding: 2px 10px;
        border-radius: 0.2rem;
        background: #f3f6fa;
        color: #6a828f;
        font-weight: 500;
        font-size: 11px;
        margin-right: 7px;
        margin-top: 4px;
        margin-bottom: 4px;
    }.jbs-grid-usrs-info {

        margin-bottom: 2rem;
    }
    .jbs-info-ico-style {
        position: relative;
        display: flex
    ;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        /* max-width: 400px; */
    }.jbs-info-ico-style.bold .jbs-single-y1 {
        font-weight: 600;
        color: #000;    font-size: 12px;}
        .jbs-info-ico-style .jbs-single-y1.style-2 span {
            background: rgb(0 68 187 / 15%);
    box-shadow: 0 0 0 4px rgb(0 68 187 / 25%);
    color: #0044bb;

    }
    .jbs-info-ico-style .jbs-single-y1.style-3 span {
        background: rgb(230 39 86 / 15%);
        box-shadow: 0 0 0 4px rgb(230 39 86 / 25%);
        color: #e62756;
    }
    .jbs-info-ico-style .jbs-single-y1 span {
        position: relative;
        display: inline-flex
    ;
        width: 18px;
        height: 18px;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 12px;
        background: red;
        box-shadow: 0 0 0 4px rgba(2, 2, 2, 0.8);
        margin-right: 10px;
    }
    .jbs-btn-groups {
        position: relative;
        display: flex
    ;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }.jbs-btn-groups .btn-gray {
        background: #f1f5f8;
        border-color: #f1f5f8;
        color: #000;
    }.jbs-btn-groups .btn-primary {
        background: #c0d1f0;
        border-color: #1ca774;
        color: var(--primary);
        border: 1px solid;
    }
    .jbs-btn-groups .btn-md {
        padding: 1em 1.5em;
        height: 45px;
        font-size: 10px;

        display: inline-flex
    ;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        -webkit-transition: all ease 0.4s;
        -o-transition: all ease 0.4s;
        transition: all ease 0.4s;
        border-radius: 0.4rem;
    }
</style>
@endpush
<section class="inner-section single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>jobs List</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jobs List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-section2">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-4 ">
 
                <div class="bg-white rounded mb-3">
                    <div class="sidebar_header d-flex align-items-center justify-content-between px-4 py-3 br-bottom">
                        <h4 class="fs-bold fs-5 mb-0">Search Filter</h4>
                        <div class="ssh-header">
                            <a href="https://eversabz.com/jobs-listing" class="clear_all ft-medium text-muted">Clear
                                All</a>
                            <a href="#search_open" data-bs-toggle="collapse" aria-expanded="false" role="button"
                                class="collapsed _filter-ico ml-2"><i class="fa-solid fa-filter"></i></a>
                        </div>
                    </div>
                    <div>
                        <div class="filter-search-box px-2 pt-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search by keywords...">
                            </div>

                        </div>
                        <div class="product-widget">
                            <h6 class="product-widget-title">
                                <a data-toggle="collapse" href="#jobcategories" role="button" aria-expanded="false"
                                    aria-controls="jobcategories" class="collapsed toggle-icon"
                                    style="display: flex; justify-content: space-between; color: #000;">
                                    <span>Job Categories</span>
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                            </h6>
                            <div class="collapse" id="jobcategories">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <ul class="no-ul-list filter-list">
                                            <li>
                                                <input id="a1" class="form-check-input" name="ADA" type="checkbox"
                                                    checked="">
                                                <label for="a1" class="form-check-label">IT Computers (62)</label>
                                            </li>
                                            <li>
                                                <input id="aa1" class="form-check-input" name="ADA" type="checkbox">
                                                <label for="aa1" class="form-check-label">Web Design (31)</label>
                                            </li>
                                            <li>
                                                <input id="aa2" class="form-check-input" name="Parking" type="checkbox">
                                                <label for="aa2" class="form-check-label">Web development (20)</label>
                                            </li>
                                            <li>
                                                <input id="aa3" class="form-check-input" name="Coffee" type="checkbox">
                                                <label for="aa3" class="form-check-label">SEO Services (43)</label>
                                            </li>
                                            <li>
                                                <input id="a2" class="form-check-input" name="Parking" type="checkbox">
                                                <label for="a2" class="form-check-label">Financial Service (16)</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-widget">
                            <h6 class="product-widget-title">
                                <a data-toggle="collapse" href="#joblocation" role="button" aria-expanded="false"
                                    aria-controls="joblocation" class="collapsed toggle-icon"
                                    style="display: flex; justify-content: space-between; color: #000;">
                                    <span>Job Locations</span>
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                            </h6>
                            <div class="collapse" id="joblocation">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <ul class="no-ul-list filter-list">
                                            <li>
                                                <input id="b1" class="form-check-input" name="ADA" type="checkbox"
                                                    checked="">
                                                <label for="b1" class="form-check-label">Australia (21)</label>
                                            </li>
                                            <li>
                                                <input id="b2" class="form-check-input" name="Parking" type="checkbox">
                                                <label for="b2" class="form-check-label">New Zeland (12)</label>
                                            </li>
                                            <li>
                                                <input id="b3" class="form-check-input" name="Coffee" type="checkbox">
                                                <label for="b3" class="form-check-label">United Kingdom (21)</label>
                                            </li>
                                            <li>
                                                <input id="ac1" class="form-check-input" name="ADA" type="checkbox">
                                                <label for="ac1" class="form-check-label">London (06)</label>
                                            </li>
                                            <li>
                                                <input id="ac2" class="form-check-input" name="Parking" type="checkbox">
                                                <label for="ac2" class="form-check-label">Manchester (07)</label>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-widget">
                            <h6 class="product-widget-title">
                                <a data-toggle="collapse" href="#skills" role="button" aria-expanded="false"
                                    aria-controls="skills" class="collapsed toggle-icon"
                                    style="display: flex; justify-content: space-between; color: #000;">
                                    <span>Skills</span>
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                            </h6>
                            <div class="collapse" id="skills">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <ul class="no-ul-list filter-list">
                                            <li>
                                                <input id="c1" class="form-check-input" name="ADA" type="checkbox"
                                                    checked="">
                                                <label for="c1" class="form-check-label">Administrative (15)</label>
                                            </li>
                                            <li>
                                                <input id="c2" class="form-check-input" name="Parking" type="checkbox">
                                                <label for="c2" class="form-check-label">iPhone &amp; Android
                                                    (33)</label>
                                            </li>
                                            <li>
                                                <input id="c3" class="form-check-input" name="Coffee" type="checkbox">
                                                <label for="c3" class="form-check-label">Java &amp; AJAX (32)</label>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="product-widget">
                            <h6 class="product-widget-title">
                                <a data-toggle="collapse" href="#filterCities" role="button" aria-expanded="false"
                                    aria-controls="filterCities" class="collapsed toggle-icon"
                                    style="display: flex; justify-content: space-between; color: #000;">
                                    <span>Experience</span>
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                            </h6>
                            <div class="collapse" id="filterCities">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <ul class="no-ul-list filter-list">
                                            <li>
                                                <input id="d1" class="form-check-input" name="ADA" type="checkbox"
                                                    checked="">
                                                <label for="d1" class="form-check-label">Beginner (54)</label>
                                            </li>
                                            <li>
                                                <input id="d2" class="form-check-input" name="Parking" type="checkbox">
                                                <label for="d2" class="form-check-label">1+ Year (32)</label>
                                            </li>
                                            <li>
                                                <input id="d3" class="form-check-input" name="Coffee" type="checkbox">
                                                <label for="d3" class="form-check-label">2+ Year (09)</label>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="product-widget">
                            <h6 class="product-widget-title">
                                <a data-toggle="collapse" href="#jobtype" role="button" aria-expanded="false"
                                    aria-controls="jobtype" class="collapsed toggle-icon"
                                    style="display: flex; justify-content: space-between; color: #000;">
                                    <span>Job Type</span>
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                            </h6>
                            <div class="collapse" id="jobtype">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <ul class="no-ul-list filter-list">
                                            <li>
                                                <input id="e2" class="form-check-input" name="jtype" type="radio">
                                                <label for="e2" class="form-check-label">Full time</label>
                                            </li>
                                            <li>
                                                <input id="e3" class="form-check-input" name="jtype" type="radio">
                                                <label for="e3" class="form-check-label">Part Time</label>
                                            </li>
                                            <li>
                                                <input id="e4" class="form-check-input" name="jtype" type="radio"
                                                    checked="">
                                                <label for="e4" class="form-check-label">Contract Base</label>
                                            </li>
                                            <li>
                                                <input id="e5" class="form-check-input" name="jtype" type="radio">
                                                <label for="e5" class="form-check-label">Internship</label>
                                            </li>
                                            <li>
                                                <input id="e6" class="form-check-input" name="jtype" type="radio">
                                                <label for="e6" class="form-check-label">Regular</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-widget">
                            <div class="form-group filter_button pt-1 pb-1 px-2">
                                <button type="submit" class="product-widget-btn">Search job</button>
                            </div>
                        </div>

                    </div>



                </div>



            </div>

            <div class="col-lg-8 col-xl-8">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="jbs-grid-usrs-block border">
                            <div class="jbs-grid-usrs-thumb">
                                <div class="jbs-grid-yuo">
                                    <a href="https://eversabz.com/storage/profile_images/hzsZE6QBsd6NyJgclwFy3IpfwjaAgbpRXNLXo8Rm.jpg">
                                        <figure><img src="https://eversabz.com/storage/profile_images/hzsZE6QBsd6NyJgclwFy3IpfwjaAgbpRXNLXo8Rm.jpg" class="img-fluid circle" alt="">
                                        </figure>
                                    </a>
                                </div>
                            </div>
                            <div class="jbs-grid-usrs-caption mb-4">
                                <div class="jbs-tiosk">
                                    <h4 class="jbs-tiosk-title"><a href="#">Mr. Vishal Jagadale</a>
                                    </h4>
                                    <div class="jbs-tiosk-subtitle"><span>Sr. Web Designer</span></div>
                                </div>
                            </div>
                            <div class="jbs-grid-job-edrs">
                                <div class="jbs-grid-job-edrs-group center">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Bootstrap</span>
                                    <span>WordPress</span>
                                </div>
                            </div>
                            <div class="jbs-grid-usrs-info">
                                <div class="jbs-info-ico-style bold">
                                    <div class="jbs-single-y1 style-2"><span><i class="fas fa-dollar-sign"></i></span>$25000/PA</div>
                                    <div class="jbs-single-y1 style-3"><span><i class='fas fa-coins'></i></span>5
                                        Years exp.</div>
                                </div>
                            </div>
                            <div class="jbs-grid-usrs-contact">
                                <div class="jbs-btn-groups">
                                    <a href="#" class="btn btn-md btn-gray px-4">Contact</a>
                                    <a href="#" class="btn btn-md btn-primary px-4">View Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
























@endsection