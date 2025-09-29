@extends('frontend.template.master')


@section('title', 'Jobs')
@section('description', 'Welcome to Eversubz')

@section('content')

@psuh('style')
<style>
.single-banner {
    margin-bottom: 0px;
}

.main-section2 {
    background: #f1f5f8 !important;
    padding: 80px 0 80px;
}

.product-widget {
    padding: 5px 10px;
    background: #ffffff;
    margin-bottom: 0px;
    border: 1px solid #f3f3f3;
}

.form-control {
    height: 40px;
    border-radius: 6px;
    width: 100%;
    background: var(--white);
    border: 1px solid #eeeeee;
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

.col-lg-8.col-xl-8 {
    padding: 0px 5px;
}

.col-xl-4.col-lg-6.col-md-6.col-6 {
    padding: 0px 5px;
}

.header-filter {
    display: block;
    margin-bottom: 0px;
}

.header-filter form {
    justify-content: space-between;
}

.job-instructor-layout {
    background: #ffffff;
    position: relative;
    display: block;
    transition: all ease 0.4s;
    border-radius: 0.6rem;
    margin-top: 1.3rem;
}

.job-instructor-layout:hover {
    background: var(--white);
    box-shadow: 0 10px 25px 0 rgb(0 0 0 / .1);    border-color: #1ca774 !important;
}

.left-tags-capt {
    top: 10px;
    left: 0;
    position: absolute;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical !important;
    -webkit-box-direction: normal !important;
    -webkit-webkit-direction: normal !important;
    -ms-flex-direction: column !important;
    -webkit-flex-direction: column !important;
    flex-direction: column !important;
}

.left-tags-capt>span {
    border-radius: 0 40px 40px 0 !important;
    margin-bottom: 0.6rem;
}

.featured-text {
    display: inline-block;
    color: #009667;
    background: rgb(0 150 103 / 15%);
    padding: 3px 15px;
    font-size: 12px;
}

.urgent {
    display: inline-block;
    color: #ff8222;
    background: rgb(255 130 34 / 15%);
    padding: 3px 15px;
    font-size: 12px;
}

.job-instructor-layout .brows-job-type span {
    position: absolute;
    padding: 4px 15px;
    top: 15px;
    right: 10px;
    line-height: 1.4;
    font-size: 11px;
    border-radius: 0.3rem;
    font-weight: 500;
}

.full-time {
    background: rgba(3, 165, 4, 0.1);
    color: #03a504;
}

.enternship {
    background: rgba(210, 0, 1, 0.1);
    color: #d20001;
}

.part-time {
    background: rgb(90 84 255 / 11%);
    color: #5a54ff;
}

.freelanc {
    background: rgba(38, 169, 225, 0.1);
    color: #26a9e1;
}

a {
    color: #000;
}

.job-instructor-thumb {
    display: table;
    text-align: center;
    width: 100%;
    padding: 50px 0px 0px;
    margin: 0 auto;
    border-radius: 8px;
}

.job-instructor-thumb img {
    display: table;
    margin: 0 auto;
    max-width: 80px;
    max-height: 80px;
}

.job-instructor-content {
    position: relative;
    padding: 0px 5px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex-direction: column;
    width: 100%;
    text-align: center;
    min-height: 80px;
}

.jbs-job-employer-wrap {
    position: relative;
    width: 100%;
}

.jbs-job-employer-wrap span {
    font-weight: 500;
    color: #000;
    font-size: 13px;
}

.instructor-title {
    line-height: 1.5;
    font-size: 15px;
    margin: 0;
}

.text-sm-muted {
    font-size: 12px;
    font-weight: 500;
    color: #000;
}

.jbs-grid-job-edrs-group {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    flex-flow: wrap;
}

.jbs-grid-job-edrs-group span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 23px;
    width: auto;
    padding: 2px 10px;
    border-radius: 0.2rem;
    background: #f3f6fa;
    color: #000;
    font-weight: 500;
    font-size: 11px;
    margin-right: 7px;
    margin-top: 4px;
    margin-bottom: 4px;
}

.jbs-grid-job-apply-btns {
    position: relative;
    width: 100%;
}

.jbs-btn-groups {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.jbs-grid-package-title.smalls h5 {
    font-size: 14px;
    margin: 0;
    color: #000;
}

.jbs-grid-package-title h5 span {
    font-size: 14px;
    font-weight: 500;
    color: #000;
}

.jbs-sng-blux .btn-light-primary {
    background: rgba(28, 167, 116, 0.12);
    border-color: rgba(28, 167, 116, 0.2);
    color: #000;
    padding: 10px 13px;
    font-size: 10px;
}
.jbs-sng-blux .btn-light-primary:hover{    background: #1ca774 !important;
    border-color: #1ca774 !important;
    color: #ffffff !important;}
.range-container {
    position: relative;
    width: 100%;
    margin-top: 15px;
}

.form-range {
    width: 100%;
    cursor: pointer;
}

.slider-value {
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(10%);
    font-size: 14px;
    font-weight: bold;
    color: #000;
}

.range-labels {
    font-size: 10px;
    margin-top: -10px;

    width: 100%;
    display: flex;
    justify-content: space-between;
}

@media only screen and (max-width: 767px) {
    .col-lg-8.col-xl-8 {
        padding: 0px 15px;

    }

    .job-instructor-thumb {
        padding: 100px 0px 0px;
    }

    .instructor-title {
        font-size: 13px;
    }
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
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Location, Zip..">
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
                                <a data-toggle="collapse" href="#jobdistance" role="button" aria-expanded="false"
                                    aria-controls="jobdistance" class="collapsed toggle-icon"
                                    style="display: flex; justify-content: space-between; color: #000;">
                                    <span>Distance in Miles</span>
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                            </h6>
                            <div class="collapse" id="jobdistance">
                                <div class="side-list no-border">
                                    <div class="range-container">
                                        <input type="range" class="form-range" id="rangeSlider" min="0" max="1000"
                                            step="1" value="500">
                                        <div class="slider-value" id="sliderValue">500</div>
                                        <div class="range-labels">
                                            <span>0</span>
                                            <span>200</span>
                                            <span>400</span>
                                            <span>600</span>
                                            <span>800</span>
                                            <span>1000</span>
                                        </div>
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
                    <div class="col-lg-12">
                        <div class="header-filter">
                            <form action="https://eversabz.com/ads-post/list" method="GET" class="d-flex">
                                <div class="filter-show"> <label class="filter-label">Show:</label> <select
                                        name="perPage" class="custom-select filter-select">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                    </select> </div>
                                <div class="filter-short ml-3"> <label class="filter-label">Sort by:</label> <select
                                        name="sortBy" class="custom-select filter-select">
                                        <option value="default">Default</option>
                                        <option value="1">Featured</option>
                                        <option value="2">Recommend</option>
                                        <option value="3">Trending</option>
                                    </select> </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="featured-text">Featured</span>
                            </div>
                            <div class="brows-job-type"><span class="full-time">Full Time</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Shopify<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Technical Content Writer</a></h4>
                                <div class="text-center text-sm-muted">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0C5.239 0 3 2.239 3 5c0 4.25 5 10.25 5 10.25S13 9.25 13 5c0-2.761-2.239-5-5-5zm0 14.562S4 9.104 4 5c0-2.209 1.791-4 4-4s4 1.791 4 4c0 4.104-4 9.562-4 9.562zM8 2C6.346 2 5 3.346 5 5s1.346 3 3 3 3-1.346 3-3S9.654 2 8 2zm0 5C7.346 7 7 6.654 7 6s.346-1 1-1 1 .346 1 1-.346 1-1 1z" />
                                        </svg>
                                        London, UK</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$80K - 110K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="featured-text">Featured</span>
                                <span class="urgent">Urgent</span>
                            </div>
                            <div class="brows-job-type"><span class="enternship">Enternship</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Deezroo<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Front-end Developer</a>
                                </h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>Canada, USA</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$50K - 70K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="urgent">Urgent</span>
                            </div>
                            <div class="brows-job-type"><span class="part-time">Part Time</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Photoshop<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Expert Team Leader</a>
                                </h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>Denver, USA</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$80K - 90K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="featured-text">Featured</span>
                            </div>
                            <div class="brows-job-type"><span class="part-time">Part Time</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Firefox<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">New Shopify Developer</a>
                                </h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>California, USA</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$90K - 100K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="featured-text">Featured</span>
                                <span class="urgent">Urgent</span>
                            </div>
                            <div class="brows-job-type"><span class="full-time">Full Time</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Air BNB<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Sr. Magento Developer</a>
                                </h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>Canada, USA</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$80K - 110K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="urgent">Urgent</span>
                            </div>
                            <div class="brows-job-type"><span class="enternship">Enternship</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Snapchat<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Sr. Code Ignetor
                                        Developer</a></h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>London, UK</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$60K - 90K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="featured-text">Featured</span>
                            </div>
                            <div class="brows-job-type"><span class="freelanc">Freelancer</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Dribbble<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Java & Python
                                        Developer</a></h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>New York, USA</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$85K - 90K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="featured-text">Featured</span>
                                <span class="urgent">Urgent</span>
                            </div>
                            <div class="brows-job-type"><span class="full-time">Full Time</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Skype<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Sr. UI/UX Designer</a>
                                </h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>Denver, USA</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$70K - 95K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="featured-text">Featured</span>
                                <span class="urgent">Urgent</span>
                            </div>
                            <div class="brows-job-type"><span class="full-time">Full Time</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Air BNB<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Sr. Magento Developer</a>
                                </h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>Canada, USA</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$80K - 110K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="urgent">Urgent</span>
                            </div>
                            <div class="brows-job-type"><span class="enternship">Enternship</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Snapchat<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Sr. Code Ignetor
                                        Developer</a></h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>London, UK</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$60K - 90K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="featured-text">Featured</span>
                            </div>
                            <div class="brows-job-type"><span class="freelanc">Freelancer</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Dribbble<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Java & Python
                                        Developer</a></h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>New York, USA</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$85K - 90K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-6">
                        <div class="job-instructor-layout border">
                            <div class="left-tags-capt">
                                <span class="featured-text">Featured</span>
                                <span class="urgent">Urgent</span>
                            </div>
                            <div class="brows-job-type"><span class="full-time">Full Time</span></div>
                            <div class="job-instructor-thumb">
                                <a href="https://eversabz.com/job-details"><img
                                        src="https://shreethemes.net/jobstock-landing-2.2/jobstock/assets/img/l-3.png"
                                        class="img-fluid" alt=""></a>
                            </div>
                            <div class="job-instructor-content">
                                <div class="jbs-job-employer-wrap"><span>Skype<span></span></span></div>
                                <h4 class="instructor-title"><a href="https://eversabz.com/job-details">Sr. UI/UX Designer</a>
                                </h4>
                                <div class="text-center text-sm-muted">
                                    <span><i class="fa-solid fa-location-dot me-2"></i>Denver, USA</span>
                                </div>
                                <div class="jbs-grid-job-edrs-group center mt-2">
                                    <span>HTML</span>
                                    <span>CSS3</span>
                                    <span>Java</span>
                                    <span>Redux</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns px-3 py-3">
                                <div class="jbs-btn-groups">
                                    <div class="jbs-sng-blux">
                                        <div class="jbs-grid-package-title smalls">
                                            <h5>$70K - 95K<span>\Year</span></h5>
                                        </div>
                                    </div>
                                    <div class="jbs-sng-blux"><a href="JavaScript:Void(0);"
                                            class="btn btn-md btn-light-primary">Quick Apply</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
const rangeSlider = document.getElementById('rangeSlider');
const sliderValue = document.getElementById('sliderValue');

function updateSliderValue() {
    const value = rangeSlider.value;
    sliderValue.textContent = value;

    const percentage = (value - rangeSlider.min) / (rangeSlider.max - rangeSlider.min) * 100;
    sliderValue.style.left = `calc(${percentage}% - 15px)`;
}

updateSliderValue();

rangeSlider.addEventListener('input', updateSliderValue);
</script>

@endsection